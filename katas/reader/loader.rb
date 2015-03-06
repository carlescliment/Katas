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

    class Name
      def extract(value)
        value.strip
      end

      def valid?(value)
        true
      end
    end
  end

  def self.load(path)
    entries = []
    CSV.foreach(path) do |row|
      name = Fields::Name.new
      balance = Fields::Balance.new
      entries << OpenStruct.new({
        name: name.extract(row[0]),
        balance: balance.extract(row[1]),
        account_number: row[2]
      }) if balance.valid?(row[1])
    end

    entries
  end
end
