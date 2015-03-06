require './fields'

module Loader
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
end
