require_relative '../lib/loader'

describe Loader do
  let (:fixture) { File.dirname(__FILE__) + '/fixture.csv' }

  it 'loads bank account data from a csv' do
    accounts = Loader.load(fixture)

    expect(accounts.size).to eql(2)
    expect(accounts[0].name).to eql('Carles Climent')
    expect(accounts[0].balance).to eql(455.12)
    expect(accounts[0].account_number).to eql('460122340199332211')
  end

  it 'discards non numeric balances' do
    accounts = Loader.load(fixture)

    expect(accounts.size).to eql(2)
  end

  it 'removes whitespaces in the name' do
    accounts = Loader.load(fixture)

    expect(accounts.size).to eql(2)
    expect(accounts[1].name).to eql('Rosa Navarro')
  end
end
