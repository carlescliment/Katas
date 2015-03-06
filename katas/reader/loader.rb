require './sources'
require './layout'
require 'ostruct'
require 'csv'

module Loader
  def self.load(path)
    layout = Layout.new
    source = CSVSource.new(path)
    layout.crawl(source)
  end
end
