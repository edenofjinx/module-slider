define([
    'jquery'
], function ($) {
    'use strict';
    return function (config, element) {
        var slider = {
            _slider: '.frontpage-slider-container',
            previousButton: '.carousel-controls .prev',
            nextButton: '.carousel-controls .next',
            carouselTrack: '.carousel-container .carousel-track',
            slideContainer: '.slider-container',
            slideIndex: 0,
            slidesPerDesktop: 3,
            sliderPerTablet: 2,
            slidesPerMobile: 1,
            slideCount: config.count,

            /**
             * @private
             */
            _create: function () {
                this._slider = $(this._slider);
            },

            /**
             * @public
             */
            init: function () {
                this._create();
                this._bindEvents();
            },

            /**
             * Bind events
             * @private
             */
            _bindEvents: function () {
                let self = this;
                $(this.nextButton).on('click', this._showNextSlides.bind(self));
                $(this.previousButton).on('click', this._showPreviousSlides.bind(self));
                $(window).on('resize', this._setSlideWidth.bind(self));
                this._setSlideWidth();
                this._toggleNextButton();
                this._displayImages();
            },

            _displayImages: function () {
                $(this.slideContainer).css('visibility', 'visible');
            },

            _showNextSlides: function (e) {
                e.preventDefault();
                this.slideIndex++;
                this._toggleShow(this.previousButton, 'block');
                this._moveSlider();
                this._toggleNextButton();
            },

            _showPreviousSlides: function (e) {
                e.preventDefault();
                this.slideIndex--;
                this._toggleShow(this.nextButton, 'block');
                this._moveSlider();
                if (this.slideIndex === 0) {
                    this._toggleShow(this.previousButton, 'none');
                }
            },

            _getContainerWidth: function () {
                return $(this._slider).width();
            },

            _getTrackOffsetWidth: function () {
                return $(this.carouselTrack).width();
            },

            _toggleNextButton: function () {
                let carouselWidth = this._getContainerWidth();
                console.log(this._getTrackOffsetWidth());
                if (this._getTrackOffsetWidth() - (this.slideIndex * carouselWidth) < carouselWidth) {
                    this._toggleShow(this.nextButton, 'none');
                } else {
                    this._toggleShow(this.nextButton, 'block');
                }
            },

            _toggleShow: function (elem, display) {
                $(elem).css('display', display);
            },

            _moveSlider: function () {
                let carouselWidth = this._getContainerWidth();
                $(this.carouselTrack).css("transform", `translateX(-${this.slideIndex * carouselWidth}px)`);
            },

            _getSlidesPerView: function () {
                let carouselWidth = $(window).innerWidth();
                if (carouselWidth > 990) {
                    return this.slidesPerDesktop;
                } else if (carouselWidth <= 990 && carouselWidth >= 670) {
                    return this.sliderPerTablet;
                } else {
                    return this.slidesPerMobile;
                }
            },

            _setSlideWidth: function () {
                let slidesPerCarousel = this._getSlidesPerView();
                let carouselWidth = this._getContainerWidth();
                let slideWidth = Math.floor((carouselWidth/slidesPerCarousel));
                console.log('carousel width: ' + carouselWidth);
                console.log('slide width:' + slideWidth);
                console.log('track width: ' + this.slideCount * slideWidth)
                $(this.slideContainer).innerWidth(slideWidth)
                $(this.carouselTrack).innerWidth(this.slideCount * slideWidth)
                this._moveSlider();
            },
        };

        return slider.init();
    };
});
