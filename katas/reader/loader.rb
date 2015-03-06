require 'ostruct'
require 'csv'

module Loader
  def self.load(path)
    entries = []
    CSV.foreach(path) do |row|
      entries << OpenStruct.new({
        name: row[0].strip,
        balance: row[1].to_f,
        account_number: row[2]
      }) if row[1] =~ /[0-9]+\.[0-9]{2}/
    end

    entries
  end
end
