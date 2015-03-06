require './layout'
require 'ostruct'
require 'csv'

module Loader
  class CSVSource
    def initialize(path)
      @path = path
    end

    def rows
      CSV.read(@path)
    end
  end

  def self.load(path)
    entries = []
    layout = Layout.new
    rows = CSVSource.new(path).rows
    rows.each do |row|
      entries << OpenStruct.new(layout.extract(row)) if layout.valid?(row)
    end

    entries
  end
end
