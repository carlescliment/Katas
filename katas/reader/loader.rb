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

  class Layout
    HEADERS = [
      Fields::Name.new,
      Fields::Balance.new,
      Fields::AccountNumber.new
    ]

    def valid?(row)
      HEADERS.zip(row).all? do |field, value|
        field.valid?(value)
      end
    end

    def extract(row)
      fields = {}
      HEADERS.zip(row).each do |field, value|
        fields[field.id] = field.extract(value)
      end

      fields
    end
  end

  def self.load(path)
    entries = []
    layout = Layout.new
    CSV.foreach(path) do |row|
      if layout.valid?(row)
        entries << OpenStruct.new(layout.extract(row))
      end
    end

    entries
  end
end
