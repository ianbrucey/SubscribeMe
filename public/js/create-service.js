

$('#trigger-add-featured-photo').click(function(e){
    $('#featured-photo').trigger('click');
});

$('.trigger-add-gallery-photos').click(function(e){
    $('#gallery-photos').trigger('click');
});

let fileArray = {};

function readFeaturedImg(input) {
    let file = input.files[0];
    if(file) {
        let reader = new FileReader();
        reader.onloadend = function (e) {
            let res         = e.currentTarget .result;
            let img         = $('#featured-photo-temp');
            let parent      = img.parent('div');
            let placeHolder = parent.children('.placeholder');
            let clearImgBtn = parent.children('.remove');

            if(!isValidImage(file)) {
                return false;
            }

            img.attr('src', res).width(30);
            fileArray[img.attr('id')] = res;
            clearImgBtn.show();
            placeHolder.hide();
        };

        reader.readAsDataURL(file);

        $('.create-service-next-step').prop('disabled', false);
    }
}

function readImages(input) {

    let queued = $('.queued');
    let empty  = $('.empty');
    let uploadLimit = queued.length === 0 ? 4 : 4 - queued.length;

    for(let t = 0; t < uploadLimit; t++) {
        let reader = new FileReader();
        let currFile = input.files[t];

        reader.onload = function (e) {
            let res         = reader.result;
            let currElement = empty.eq(t).children('img');
            let parent      = currElement.parent('div');
            let placeHolder = parent.children('.placeholder');
            let clearImgBtn = parent.children('.remove');

            if(!isValidImage(currFile)) {
                return false;
            }

            currElement.attr('src', res).width(30);

            parent.removeClass('empty').addClass('queued');
            fileArray[currElement.attr('id')] = res;
            clearImgBtn.show();
            placeHolder.hide();
        };

        reader.readAsDataURL(currFile);


    }

}

function clearImage(input) {
    let imgId       = $(input).attr('data-target');
    let img         = $(imgId);
    let parent      = img.parent('div');
    let placeHolder = parent.children('.placeholder');
    let clearImgBtn = parent.children('.remove');
    if(!img.hasClass('featured-photo-temp')) {
        parent.removeClass('queued').addClass('empty');
    } else {
        $('.create-service-next-step').prop('disabled', true);
    }
    img.attr('src', '');
    fileArray[img.attr('id')] = null;
    placeHolder.show();
    clearImgBtn.hide();
    console.log(fileArray);
}

let step1 = $('#create-service-step1');
let step2 = $('#create-service-step2');
$('.create-service-next-step').on('click', function () {
    step1.fadeOut(500);
    step2.fadeIn(700);
});

$('.create-service-previous-step').on('click', function () {
    step1.fadeIn(700);
    step2.fadeOut(500);
});