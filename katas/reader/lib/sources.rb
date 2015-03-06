module Loader
  class CSVSource
    def initialize(path)
      @path = path
    end

    def rows
      CSV.read(@path)
    end
  end
end
