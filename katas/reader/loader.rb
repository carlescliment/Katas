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
    layout = Layout.new
    source = CSVSource.new(path)
    layout.crawl(source)
  end
end
