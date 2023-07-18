$(document).ready(function() {

    let d = new Date()
    let currentYear = d.getFullYear()

    let priceMin = $('#filter-price-min').val()
    let priceMax = $('#filter-price-max').val()

    let kmMin = $('#filter-km-min').val()
    let kmMax = $('#filter-km-max').val()

    let yearMin = $('#filter-year-min').val()

    let carPrice = new Array()

    $('#label-price-min').append(` ${priceMin} €`)
    $('#label-price-max').append(` ${priceMax} €`)

    $('#label-km-min').append(` ${kmMin} kms`)
    $('#label-km-max').append(` ${kmMax} kms`)

    $('#label-year-min').append(` ${yearMin}`)
    $('#label-year-max').append(` ${currentYear}`)

    // Update label text after change on input type range
    $('input[type="range"]').on('input', function() {
        let label = $(this).prev('label')
        let splitLabel = label.text().split(':')
        let labelUnits = label.text().substring(label.text().length -1)
        let units;
        let newFilterValue = $(this).val()

        if(labelUnits === '€') {
            units = '€'
        } else if(labelUnits === 's') {
            units = 'kms'
        } else {
            units = ''
        }

        label.text(`${splitLabel[0]} : ${newFilterValue} ${units}`)
    })

    $('div.card').each(function() {
        carPrice.push($('div.car-price').text().replaceAll(' ', '').split('€'))
    })

    $('#filter-price-min, #filter-price-max').on('change', function() {

        priceMin = $('#filter-price-min').val()
        priceMax = $('#filter-price-max').val()
        
        for(let i = 0; i < carPrice.length; i++) {
            if(carPrice[i] > priceMin && carPrice[i] < priceMax) {
                console.log(`Min price is : ${priceMin} and max price is : ${priceMax}`)
            } else {
                $(this).hide()
            }
        }
    })



}) // End of document ready