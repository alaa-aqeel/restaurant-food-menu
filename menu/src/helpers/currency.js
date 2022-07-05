

export function format(price) {

    return Number(price).toLocaleString('en-IQ', {
        style: 'currency',
        currency: 'IQD',
        currencyDisplay: 'symbol',
        maximumSignificantDigits: 20
    })
}

