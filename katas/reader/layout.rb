require './fields'

module Loader
  class Layout
    HEADERS = [
      Fields::Name.new,
      Fields::Balance.new,
      Fields::AccountNumber.new
    ]

    def crawl(source)
      entries = []
      source.rows.each do |row|
        entries << OpenStruct.new(extract(row)) if valid?(row)
      end

      entries
    end

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
