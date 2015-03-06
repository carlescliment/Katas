require 'ostruct'
require 'csv'


module Loader
  module Fields
    class Balance
      def extract(value)
        value.to_f 
      end

      def valid?(value)
        value =~ /[0-9]+\.[0-9]{2}/
      end
    end
  end

  def self.load(path)
    entries = []
    CSV.foreach(path) do |row|
      balance = Fields::Balance.new
      entries << OpenStruct.new({
        name: row[0].strip,
        balance: balance.extract(row[1]),
        account_number: row[2]
      }) if balance.valid?(row[1])
    end

    entries
  end
end
