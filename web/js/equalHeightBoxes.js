$(window).on('load', setBoxHeight)
$(window).resize(setBoxHeight)

function setBoxHeight() {
    let columnWidth = $('#teamsColumn').width()
    let box = $('.col-lg-4.col-md-6.text-center')
    var boxesInRow = 1

    //goes until the number of boxes in the row would be too long
    while((boxesInRow + 1)*box.width() < columnWidth) {
        boxesInRow++
    }
    
    $.each($('.row.department') , function(i, department) {
    
        //console.log(boxesInRow)
        var heights = $(department).children('.col-lg-4.col-md-6.text-center').map(function() {
            return $(this).height()
        })

        //create array of row max heights
        //and array to hold indexes of rowMaxHeights in parallel with the array of boxes
        var rowMaxHeights = [0]
        var maxHeightsIndex = 0
        var heightIndexes = []

        $.each(heights, function(i, height) {
            //check if we are on a new row
            if(i%boxesInRow==0 && i!=0) {
                //console.log(maxHeightsIndex + ': ' + rowMaxHeights[maxHeightsIndex])
                maxHeightsIndex++
                rowMaxHeights.push(0)
            }

            if(heights[i] > rowMaxHeights[maxHeightsIndex]) {
                rowMaxHeights[maxHeightsIndex] = height 
            }

            heightIndexes.push(maxHeightsIndex)
        })

        //apply row max heights to each box
        $.each($(department).children('.col-lg-4.col-md-6.text-center') , function(i, box) {
            $(box).height(rowMaxHeights[heightIndexes[i]])
        })
    })
}