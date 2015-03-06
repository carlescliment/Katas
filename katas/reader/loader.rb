require 'ostruct'
require 'csv'


module Loader
  module Fields
    class Balance
      def id
        :balance
      end

      def extract(value)
        value.to_f 
      end

      def valid?(value)
        value =~ /[0-9]+\.[0-9]{2}/
      end
    end

    class Name
      def id
        :name
      end

      def extract(value)
        value.strip
      end

      def valid?(value)
        true
      end
    end

    class AccountNumber
      def id
        :account_number
      end

      def extract(value)
        value
      end

      def valid?(value)
        true
      end
    end
  end

  def self.load(path)
    entries = []
    CSV.foreach(path) do |row|
      if self.row_valid?(row)
        entries << OpenStruct.new(extract_fields(row))
      end
    end

    entries
  end

  def self.row_valid?(row)
    layout = [
      Fields::Name.new,
      Fields::Balance.new,
      Fields::AccountNumber.new
    ]
    layout.zip(row).all? do |field, value|
      field.valid?(value)
    end
  end

  def self.extract_fields(row)
    layout = [
      Fields::Name.new,
      Fields::Balance.new,
      Fields::AccountNumber.new
    ]

    fields = {}
    layout.zip(row).each do |field, value|
      fields[field.id] = field.extract(value)
    end

    fields
  end
end
