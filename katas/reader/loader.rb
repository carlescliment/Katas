require './layout'
require 'ostruct'
require 'csv'

module Loader
  def self.load(path)
    entries = []
    layout = Layout.new
    CSV.foreach(path) do |row|
      entries << OpenStruct.new(layout.extract(row)) if layout.valid?(row)
    end

    entries
  end
end
