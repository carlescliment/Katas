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
end
