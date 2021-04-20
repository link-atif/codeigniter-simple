let elementMegatix = document.getElementById('elementMegatix');
if (elementMegatix) {
    elementMegatix.innerHTML = megatixForm
}
var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    },
    none: function() {
        return (!isMobile.any());
    }
};
const explore = document.querySelector(".explore")
const exploreMenu = document.querySelector(".explore-menu")
const exploreMenus = document.querySelectorAll('.explore-menu .explore-menu-item');
const exploreMenuParent = document.querySelector('.explore-menu');
const header = document.querySelector(".header")
const exploreAnchor = document.querySelectorAll('.explore a')
if (!isMobile.any()) {
    exploreMenus.forEach(menu => {
        menu.addEventListener('mouseover', (event) => {
            if (!event.target.classList.contains('active')) {
                const overlay = document.querySelector('.explore .overlay')
                if (overlay) {
                    if (!overlay.classList.contains('active')) {
                        TweenMax.fromTo(overlay, .5, {
                            opacity: .5
                        }, {
                            opacity: 1
                        })
                    }
                    overlay.classList.add('active')
                }
                const footer = document.querySelector('.footer');
                if (footer && !footer.classList.contains('hide')) {
                    footer.classList.add('hide');
                }
                if (!exploreMenuParent.classList.contains('.active')) {
                    exploreMenuParent.classList.add('active');
                }
                if (exploreMenuParent)
                    exploreMenus.forEach(childMenu => {
                        childMenu.classList.remove('active');
                    })
                const target = event.target;
                target.classList.add('active');
                const menuElements = document.querySelectorAll('.explore-detail');
                menuElements.forEach(menuElement => {
                    menuElement.classList.remove('active');
                })
                const targetSlug = target.getAttribute('data-slug');
                const menuElement = document.querySelector('.explore-detail.' + targetSlug);
                menuElement.classList.add('active');
                const menuElementChild = menuElement.children;
                [...menuElementChild].forEach(function(element) {
                    const exploreInner = element.querySelector('.explore-inner');
                    TweenMax.set(exploreInner.children, {
                        opacity: 0
                    })
                })
                TweenMax.staggerFromTo(menuElementChild, .4, {
                    opacity: 0,
                    scale: 1,
                }, {
                    opacity: 1,
                    scale: 1.03,
                    onComplete: function(event) {
                        const target = this.target.querySelector('.explore-inner')
                        TweenMax.staggerFromTo(target.children, .4, {
                            y: 10,
                            opacity: 0,
                        }, {
                            y: 0,
                            opacity: 1,
                        }, .3)
                    }
                }, .1)
            }
        })
    });
    if (exploreAnchor) {
        exploreAnchor.forEach(function(anchor) {
            anchor.addEventListener('click', function(event) {
                event.preventDefault();
                let href = event.target.getAttribute("href");
                if (!href) {
                    const parentElement = event.target.parentElement;
                    href = parentElement.getAttribute('href');
                }
                if (href) {
                    exploreMenu.classList.add("slide-left");
                    setTimeout(() => {
                        explore.classList.add("opacity");
                        header.classList.add("opacity");
                    }, 1000)
                    setTimeout(() => {
                        window.location = href;
                    }, 2000)
                }
            })
        })
    }
}
const mobileMenus = document.querySelectorAll('.explore-menu-item');
if (mobileMenus && isMobile.any()) {
    mobileMenus.forEach(function(menu) {
        menu.addEventListener('click', function(element) {
            const url = element.target.getAttribute('data-slug')
            const noMenu = element.target.classList.contains("no-menu");
            if (!noMenu) {
                const menuElement = document.querySelector(`.menu.mobile.${url}`);
                menuElement.classList.add('active')
                const navElement = menuElement.querySelector('.nav .title');
                const returnButton = menuElement.querySelector('.return-button');
                returnButton.addEventListener('click', () => {
                    menuElement.classList.remove('active');
                })
            }
        })
    })
}
const customSelects = document.querySelectorAll('.custom-select-container');
var property = 'studio';
var megatixEvent;
if (customSelects.length) {
    customSelects.forEach(function(select) {
        const customSelect = select.querySelector('.custom-select')
        const customSelectValue = select.querySelector('.custom-select .custom-select-value')
        const selectOption = select.querySelector('.custom-select-options')
        select.addEventListener('click', function(event) {
            event.stopPropagation()
            if (!selectOption.classList.contains('active')) {
                customSelects.forEach(function(cusSelect) {
                    const cusSelectSelect = cusSelect.querySelector('.custom-select')
                    if (cusSelectSelect.classList.contains('active')) {
                        cusSelectSelect.classList.remove('active')
                    }
                    const cusSelectOption = cusSelect.querySelector('.custom-select-options')
                    if (cusSelectOption.classList.contains('active')) {
                        cusSelectOption.classList.remove('active')
                    }
                })
                selectOption.classList.add('active')
                customSelect.classList.add('active')
            } else {
                selectOption.classList.remove('active')
                customSelect.classList.remove('active')
            }
        })
        const selectOptions = select.querySelectorAll('.custom-select-item')
        if (selectOptions.length) {
            const eventContainer = document.querySelector('.event-container');
            const eventImage = eventContainer.querySelector('.event-image img');
            const eventDate = eventContainer.querySelector('.event-text .event-text-text.date');
            const eventVenue = eventContainer.querySelector('.event-text .event-text-text.title');
            selectOptions.forEach(function(option) {
                option.addEventListener('click', function(event) {
                    customSelectValue.innerHTML = event.target.innerHTML;
                    if (option.hasAttribute('event-id')) {
                        const eventId = option.getAttribute("event-id");
                        megatixEvent = megatixData[eventId];
                        eventImage.src = megatixEvent.cover;
                        eventDate.innerHTML = megatixEvent.start_datetime;
                        eventVenue.innerHTML = megatixEvent.venue.name;
                        if (!eventContainer.classList.contains('active')) {
                            eventContainer.classList.add('active');
                        }
                    }
                })
            })
        }
    })
}
var roomCalendarStartDate = moment()
var roomCalendarEndDate = moment().add(1, 'days')
var roomCalendarCheckInConfig = {
    field: document.querySelector('#book-only-checkin'),
    format: 'DD MMM YYYY',
    container: document.querySelector('.calendar-container.checkin'),
    minDate: moment().toDate(),
    onSelect: function(date) {
        roomCalendarCheckOut.setMinDate(moment(date).add(1, 'd').toDate())
        roomCalendarCheckOut.setDate(moment(date).add(1, 'd').toDate())
        roomCalendarStartDate = moment(date)
        roomCalendarEndDate = moment(date).add(1, 'd')
    }
}

function initPikaday(config) {
    const pikaday = new Pikaday(config)
    return pikaday
}
const calendarContainers = document.querySelectorAll('.calendar-container')
let pikadayArray = []
if (calendarContainers.length) {
    calendarContainers.forEach(function(container) {
        const key = container.getAttribute('key');
        const input = container.querySelector('input')
        const config = {
            field: input,
            format: 'DD MMM YYYY',
            container: container,
            minDate: moment().toDate()
        }
        const type = container.getAttribute('type')
        const relation = container.getAttribute('relation')
        if (type === 'from') {
            config.onSelect = function(date) {
                pikadayArray[relation].setMinDate(moment(date).add(1, 'd').toDate())
                pikadayArray[relation].setDate(moment(date).add(1, 'd').toDate())
            }
        }
        pikadayArray[key] = initPikaday(config)
    })
}
const newsletterThankyou = document.querySelector(".newsletter-thankyou");
if (newsletterThankyou) {
    const url = new URL(window.location.href)
    var urlParams = url.searchParams.get("m");
    if (urlParams === "thankyou") {
        newsletterThankyou.classList.add("active")
    }
}
const megaMenuItems = document.querySelectorAll(".top-menu.megamenu li")
const megaMenus = document.querySelectorAll(".child-menu.megamenu")
if (megaMenuItems.length) {
    let isMobile = /iPad|iPod/i.test(navigator.userAgent);
    if (isMobile) {
        megaMenuItems.forEach(function(menuItem) {
            menuItem.addEventListener("click", function(event) {
                event.preventDefault();
                const megaMenuID = event.target.parentNode.getAttribute("data-hover");
                const megaMenu = document.querySelector("." + megaMenuID);
                var cekCurentActiveMenu
                megaMenus.forEach(function(element) {
                    if (element.classList.contains("active")) {
                        cekCurentActiveMenu = element
                        element.classList.remove("active")
                    }
                })
                if (!cekCurentActiveMenu) {
                    megaMenu.classList.add("active")
                }
            })
        })
    } else {
        megaMenuItems.forEach(function(menuItem) {
            menuItem.addEventListener("mouseenter", function(event) {
                const megaMenuID = event.target.getAttribute("data-hover");
                const megaMenu = document.querySelector("." + megaMenuID);
                megaMenus.forEach(function(element) {
                    if (element.classList.contains("active")) {
                        element.classList.remove("active")
                    }
                })
                megaMenu.classList.add("active")
            })
        })
    }
}
if (megaMenus.length) {
    megaMenus.forEach(function(megaMenu) {
        megaMenu.addEventListener("mouseleave", function(event) {
            if (event.target.classList.contains("active")) {
                event.target.classList.remove("active")
            }
        })
    })
}
const pageUrl = new URL(window.location.href)
const eventFilter = pageUrl.searchParams.get("filter")
const calendarButton = document.querySelector(".child-menu .calendar-button span");
if (calendarButton) {
    switch (eventFilter) {
        case "today":
            const todayDate = moment().format("DD MMM YYYY")
            calendarButton.innerHTML = todayDate
            break;
        case "next7days":
            const weekStart = moment().format("DD MMM")
            const weekEnd = moment().add(6, 'day').format("DD MMM YYYY")
            const weekDate = weekStart + " â€ " + weekEnd
            calendarButton.innerHTML = weekDate
            break;
        case "next30days":
            const monthStart = moment().format("DD MMM")
            const monthEnd = moment().add(29, 'day').format("DD MMM YYYY")
            const monthDate = monthStart + " â€ " + monthEnd
            calendarButton.innerHTML = monthDate
            break;
    }
}
const bookingDesktop = document.querySelector('.header-right .button.pop-up');
const bookingMobile = document.querySelector('.booking-mobile');
const innerClose = document.querySelector('.booking-popup-item-close')
const backMobile = document.querySelectorAll('.back-mobile')
const bookingItems = document.querySelectorAll('.booking-popup-item.popup')
const bookingPopup = document.querySelector('.booking-popup')
if (bookingDesktop) {
    const menuImageTitle = bookingDesktop.querySelector('.menu-image-title');
    let menuImageDefaultTitle
    if (menuImageTitle) {
        menuImageDefaultTitle = menuImageTitle.innerHTML;
    }
    let isBookingOpen = false
    bookingDesktop.addEventListener('click', function(event) {
        event.preventDefault();
        const parentElement = event.target.parentElement
        const popupMenuElements = document.querySelectorAll('.booking-right-container')
        const bookingAnchor = bookingDesktop.querySelector('a')
        if (!isBookingOpen) {
            isBookingOpen = true
            bookingAnchor.classList.add('close')
            menuImageTitle.innerHTML = 'Close'
            if (bookingPopup && !bookingPopup.classList.contains('active')) {
                bookingPopup.classList.add('active')
            }
            if (bookingItems) {
                const dataSlugFirst = bookingItems[0].getAttribute('data-slug');
                const bookingContainerFirst = document.querySelector('.booking-right-container.' + dataSlugFirst)
                bookingContainerFirst.classList.add("active")
                bookingItems.forEach(function(bookingItem) {
                    if (!isMobile.any()) {
                        bookingItem.addEventListener('mouseover', function(event) {
                            bookingItems.forEach(function(bookEl) {
                                if (bookEl.classList.contains('active')) {
                                    bookEl.classList.remove('active')
                                }
                            })
                            bookingItem.classList.add('active')
                            const dataSlug = bookingItem.getAttribute('data-slug');
                            popupMenuElements.forEach(function(bookingMenu) {
                                if (bookingMenu.classList.contains('active')) {
                                    bookingMenu.classList.remove('active')
                                }
                            })
                            const bookingContainer = document.querySelector('.booking-right-container.' + dataSlug)
                            if (bookingContainer) {
                                bookingContainer.classList.add("active")
                            }
                        })
                    }
                    if (isMobile.any()) {
                        bookingItem.addEventListener('click', function(event) {
                            if (!bookingItem.classList.contains('active')) {
                                bookingItems.forEach(function(item) {
                                    if (item.classList.contains('active')) {
                                        item.classList.remove('active')
                                    }
                                })
                                bookingItem.classList.add('active')
                            } else {
                                bookingItem.classList.remove('active')
                            }
                        })
                    }
                })
            }
        } else {
            isBookingOpen = false
            if (bookingAnchor.classList.contains('close')) {
                bookingAnchor.classList.remove('close')
            }
            if (bookingPopup.classList.contains('active')) {
                bookingPopup.classList.remove('active')
            }
            popupMenuElements.forEach(function(element) {
                if (element.classList.contains('active')) {
                    element.classList.remove('active')
                }
            })
            if (menuImageDefaultTitle) menuImageTitle.innerHTML = menuImageDefaultTitle
        }
        if (innerClose) {
            innerClose.addEventListener('click', function(event) {
                isBookingOpen = false
                if (parentElement.classList.contains('close')) {
                    parentElement.classList.remove('close')
                }
                if (bookingPopup.classList.contains('active')) {
                    bookingPopup.classList.remove('active')
                }
                popupMenuElements.forEach(function(element) {
                    if (element.classList.contains('active')) {
                        element.classList.remove('active')
                    }
                })
                if (menuImageDefaultTitle) menuImageTitle.innerHTML = menuImageDefaultTitle
            })
        }
        if (typeof fbq != 'undefined') {
            fbq('track', 'BookNowButton')
        }
    })
}
if (bookingMobile) {
    if (!bookingMobile.classList.contains("no-child")) {
        console.log('tidak');
        bookingItems.forEach(function(item) {
            const popupTitle = item.querySelector('.popup-item-title')
            const height = popupTitle ? popupTitle.clientHeight : 50;
            item.style.height = height + 'px'
            popupTitle.style.height = height + 'px'
        })
        bookingMobile.addEventListener('click', function(event) {
            console.log('yang ini')
            if (bookingMobile.classList.contains("no-child")) {
                console.log('contain')
            } else {
                console.log('clear')
            }
            event.preventDefault()
            if (bookingPopup && !bookingPopup.classList.contains('active')) {
                bookingPopup.classList.add('active')
            }
            const bookingContainer = document.querySelector('.booking-popup-container')
            bookingItems.forEach(function(bookingItem) {
                bookingItem.addEventListener('click', function(event) {
                    if (!bookingItem.classList.contains('active')) {
                        bookingItems.forEach(function(item) {
                            if (item.classList.contains('active')) {
                                item.classList.remove('active')
                            }
                        })
                        bookingItem.classList.add('active')
                    } else {
                        bookingItem.classList.remove('active')
                    }
                })
            })
            if (innerClose) {
                innerClose.addEventListener('click', function(event) {
                    isBookingOpen = false
                    if (bookingPopup.classList.contains('active')) {
                        bookingPopup.classList.remove('active')
                    }
                    bookingItems.forEach(function(item) {
                        if (item.classList.contains('active')) {
                            item.classList.remove('active')
                        }
                    })
                })
            }
            backMobile.forEach(function(back) {
                back.addEventListener('click', function(event) {
                    if (bookingContainer.classList.contains('active')) {
                        bookingContainer.classList.remove('active');
                    }
                })
            })
        })
    }
}
const bookingInner = document.querySelector('.sticky-book-now')
if (bookingInner) {
    let isBookingOpen = false
    const bookingItems = document.querySelectorAll('.booking-popup-item')
    const bookingPopup = document.querySelector('.booking-popup')
    const popupMenuElements = document.querySelectorAll('.booking-right-container')
    const innerSticky = bookingInner.querySelector('.sticky-container');
    const innerStickyDefault = innerSticky.innerHTML;
    bookingInner.addEventListener('click', function(event) {
        event.preventDefault();
        event.stopPropagation();
        if (!isBookingOpen) {
            isBookingOpen = true
            if (bookingPopup && !bookingPopup.classList.contains('active')) {
                bookingPopup.classList.add('active')
            }
            bookingInner.classList.add('active')
            innerSticky.innerHTML = '<span class="sticky-book-title">Close</span>'
            if (bookingItems) {
                const dataSlugFirst = bookingItems[0].getAttribute('data-slug');
                const bookingContainerFirst = document.querySelector('.booking-right-container.' + dataSlugFirst)
                bookingContainerFirst.classList.add("active")
                const popupMenuElements = document.querySelectorAll('.booking-right-container')
                bookingItems.forEach(function(bookingItem) {
                    if (!isMobile.any()) {
                        bookingItem.addEventListener('mouseover', function(event) {
                            bookingItems.forEach(function(bookEl) {
                                if (bookEl.classList.contains('active')) {
                                    bookEl.classList.remove('active')
                                }
                            })
                            bookingItem.classList.add('active')
                            const dataSlug = bookingItem.getAttribute('data-slug');
                            popupMenuElements.forEach(function(bookingMenu) {
                                if (bookingMenu.classList.contains('active')) {
                                    bookingMenu.classList.remove('active')
                                }
                            })
                            const bookingContainer = document.querySelector('.booking-right-container.' + dataSlug)
                            bookingContainer.classList.add("active")
                        })
                    }
                    if (isMobile.any()) {
                        bookingItem.addEventListener('click', function(event) {
                            const dataSlug = event.target.getAttribute('data-slug');
                            popupMenuElements.forEach(function(bookingMenu) {
                                if (bookingMenu.classList.contains('active')) {
                                    bookingMenu.classList.remove('active')
                                }
                            })
                            const bookingContainer = document.querySelector('.booking-right-container.' + dataSlug)
                            bookingContainer.classList.add("active")
                        })
                    }
                })
            }
        } else {
            isBookingOpen = false
            innerSticky.innerHTML = innerStickyDefault
            if (bookingInner.classList.contains('active')) {
                bookingInner.classList.remove('active')
            }
            if (bookingPopup.classList.contains('active')) {
                bookingPopup.classList.remove('active')
            }
            popupMenuElements.forEach(function(element) {
                if (element.classList.contains('active')) {
                    element.classList.remove('active')
                }
            })
        }
        if (innerClose) {
            innerClose.addEventListener('click', function(event) {
                isBookingOpen = false
                innerSticky.innerHTML = innerStickyDefault
                if (bookingInner.classList.contains('active')) {
                    bookingInner.classList.remove('active')
                }
                if (bookingPopup.classList.contains('active')) {
                    bookingPopup.classList.remove('active')
                }
                popupMenuElements.forEach(function(element) {
                    if (element.classList.contains('active')) {
                        element.classList.remove('active')
                    }
                })
            })
        }
    }, false)
}
window.onload = function() {
    setTimeout(function() {
        const megamenus = document.querySelectorAll(".block.child-menu.megamenu");
        if (megamenus.length) {
            megamenus.forEach(function(menu) {
                menu.classList.remove("active");
            })
        }
    }, 3000)
}
const returnBackMenu = document.querySelector(".return-button.menu");
const mobileMenu = document.querySelector(".main-wrapper-post .menu.mobile");
if (mobileMenu) {
    const mobileMenuBack = mobileMenu.querySelector(".return-button");
    if (returnBackMenu) {
        returnBackMenu.addEventListener("click", function(event) {
            mobileMenu.classList.add("active");
        })
    }
    if (mobileMenuBack) {
        mobileMenuBack.addEventListener("click", function() {
            mobileMenu.classList.remove("active");
        })
    }
}
const returnBackForm = document.querySelector(".return-back-title");
const menuBooking = document.querySelector(".menu.mobile");
if (returnBackForm) {
    const returnMenuBooking = menuBooking.querySelector(".return-button")
    returnMenuBooking.addEventListener("click", function() {
        menuBooking.classList.remove("active");
    })
    returnBackForm.addEventListener("click", function(event) {
        menuBooking.classList.add("active");
    })
}
const tableCheckPikaday = document.querySelector('#start_date_tablecheck')
if (tableCheckPikaday) {
    new Pikaday({
        field: document.querySelector('#start_date_tablecheck'),
        defaultDate: moment(),
        minDate: moment().add(1, 'day').endOf('day').toDate()
    });
}
const adder = document.querySelectorAll('.custom-adder-container');
if (adder.length) {
    adder.forEach(function(add) {
        const maxValue = add.getAttribute('max');
        const minValue = add.getAttribute('min');
        const addValueElement = add.querySelector('.adder-value')
        const addPlus = add.querySelector('.adder-plus')
        const addMinus = add.querySelector('.adder-minus')
        addPlus.addEventListener('click', function(event) {
            event.stopPropagation()
            const addValue = addValueElement.innerHTML
            if (addValue < maxValue) {
                addValueElement.innerHTML = parseInt(addValue) + 1
            }
        })
        addMinus.addEventListener('click', function() {
            const addValue = addValueElement.innerHTML
            if (addValue > minValue) {
                addValueElement.innerHTML = parseInt(addValue) - 1
            }
        })
    })
}
const bookCalendar = document.querySelectorAll('.book-calendar')
if (bookCalendar.length) {
    bookCalendar.forEach(function(bookCal) {
        bookCal.addEventListener('focus', function(event) {
            const parentElement = event.target.parentElement
            parentElement.classList.add('active')
        })
        bookCal.addEventListener('blur', function(event) {
            const parentElement = event.target.parentElement
            parentElement.classList.remove('active')
        })
    })
}

function getCustomSelectValue(name) {
    const customSelectElement = document.querySelector(`div.custom-select-container[name="${name}"]`)
    const value = customSelectElement.querySelector('.custom-select-value');
    return value.innerHTML
}

function getDateValue(name) {
    const dateElement = document.querySelector(`div.calendar-container[name="${name}"]`)
    const input = dateElement.querySelector('input')
    return input.value
}

function getAdderValue(name) {
    const adderElement = document.querySelector(`div.custom-adder-container[name="${name}"`)
    const adderValue = adderElement.querySelector('.adder-value');
    return adderValue.innerHTML
}

function objToParams(obj) {
    var str = ''
    for (var key in obj) {
        if (str != '') {
            str += "&"
        }
        str += key + "=" + obj[key];
    }
    return str
}

function synsixHandler(event) {
    if (!event.target.classList.contains('active')) return
    var property = 'studio'
    property = getCustomSelectValue('hotel')
    const startDate = getDateValue('from')
    const endDate = getDateValue('to')
    const adults = getAdderValue('adults')
    const children = getAdderValue('children')
    var url = ''
    if (property == 'Katamama Suites' || property == 'Potato Head Suites') {
        url = "https://be.synxis.com/?hotel=67458&chain=10237&currency=IDR&promo=direct&"
        if (typeof fbq != 'undefined') {
            fbq('track', 'PHCheckAvailButton');
        }
    } else if (property == 'Potato Head Studios') {
        url = "https://be.synxis.com/?hotel=7459&chain=24883&promo=direct&rooms=1&sbe_rc=NzQ1OVNDMDAzNTgz&"
        if (typeof fbq != 'undefined') {
            fbq('track', 'KatamamaCheckAvailButton');
        }
    }
    var synsixObject = {
        arrive: moment(startDate).format("YYYY-MM-DD"),
        depart: moment(endDate).format("YYYY-MM-DD"),
        adult: adults,
        child: children,
        currency: 'IDR'
    }
    var actualUrl = objToParams(synsixObject)
    var actualUrl = objToParams(synsixObject)
    let destinationUrl = url + actualUrl
    ga(function(tracker) {})
    var trackers, linker;
    if (typeof ga !== 'undefined' && typeof ga.getAll === 'function') {
        trackers = ga.getAll();
        if (trackers.length) {
            linker = new window.gaplugins.Linker(trackers[0]);
            destinationUrl = linker.decorate(destinationUrl);
        }
        if (_gat !== undefined && typeof _gat._getTrackers === 'function') {
            trackers = _gat._getTrackers();
            if (trackers.length) {
                destinationUrl = trackers[0]._getLinkerUrl(destinationUrl);
            }
        }
        window.open(destinationUrl, '_blank');
    }
}

function tableCheckHandler(event) {
    if (!event.target.classList.contains('active')) return
    const restaurant = getCustomSelectValue('restaurant');
    const people = getAdderValue('party_size')
    const children = getAdderValue('children')
    const time = getCustomSelectValue('time')
    const startDate = getDateValue('date')
    let restaurantID
    if (restaurant === 'Kaum') {
        restaurantID = 'potato-head-bali-kaum'
        if (typeof fbq != 'undefined') {
            fbq('track', 'KaumCheckAvailButton');
        }
    } else if (restaurant === 'Ijen') {
        restaurantID = 'potato-head-bali-ijen'
        if (typeof fbq != 'undefined') {
            fbq('track', 'IjenCheckAvailButton');
        }
    } else if (restaurant === 'Pizza Garden') {
        restaurantID = 'potato-head-bali-pizza-garden'
        if (typeof fbq != 'undefined') {
            fbq('track', 'PizzaGardenCheckAvailButton')
        }
    } else if (restaurant === 'Tanaman') {
        restaurantID = 'potato-head-bali-tanaman'
        if (typeof fbq != 'undefined') {
            fbq('track', 'TanamanCheckAvailButton')
        }
    }
    const tableCheckObject = {
        start_date: moment(startDate).format('YYYY-MM-DD'),
        start_time: time,
        num_people: people,
        num_people_child: children
    }
    const url = `https://www.tablecheck.com/en/shops/${restaurantID}/reserve?`
    const actualUrl = objToParams(tableCheckObject)
    window.open(url + actualUrl, '_blank')
}

function megatixHandler(event) {
    if (typeof fbq != 'undefined') {
        fbq('track', 'BuyTicketButton');
    }
    const eventId = megatixEvent.id
    const url = `https://megatix.co.id/events/${eventId}`
    window.open(url, '_blank')
}
const avaibilitySynsixButton = document.querySelector('.check-availability-synsix')

function checkAvaibilitySynsix() {
    const property = (getCustomSelectValue('hotel') !== 'Select a hotel') ? getCustomSelectValue('hotel') : null
    if (property !== null && avaibilitySynsixButton) {
        if (!avaibilitySynsixButton.classList.contains('active')) {
            avaibilitySynsixButton.classList.add('active')
        }
    }
}
const avaibilityTableCheckButton = document.querySelector('.check-availability-tablecheck')

function checkTableCheck() {
    const restaurant = (getCustomSelectValue('restaurant') !== 'Restaurant') ? getCustomSelectValue('restaurant') : null;
    const time = (getCustomSelectValue('time') !== 'Select a Time') ? getCustomSelectValue('time') : null
    if (restaurant && time && avaibilityTableCheckButton) {
        if (!avaibilityTableCheckButton.classList.contains('active')) {
            avaibilityTableCheckButton.classList.add('active')
        }
    }
}
const avaibilityMegatixButton = document.querySelector('.check-availability-megatix')

function checkMegatix() {
    const event = (getCustomSelectValue('event') !== 'Event Name') ? getCustomSelectValue('event') : null;
    if (event && avaibilityMegatixButton) {
        if (!avaibilityMegatixButton.classList.contains('active')) {
            avaibilityMegatixButton.classList.add('active')
        }
    }
}
const checkButton = document.querySelector('.check-availability-synsix')
const checkTable = document.querySelector('.check-availability-tablecheck')
if (checkButton || checkTable) {
    setInterval(function() {
        checkAvaibilitySynsix();
        checkTableCheck();
        checkMegatix()
    }, 300)
}
const bookingPopupContents = document.querySelectorAll('.popup-item-content')
if (bookingPopupContents.length) {
    bookingPopupContents.forEach(function(content) {
        content.addEventListener('click', function(event) {
            event.stopPropagation()
        })
    })
}
const videoBackground = document.querySelector('.video-background video')
const soundController = document.querySelector('.header-right .sound')
let isSoundPlay = false
if (videoBackground && soundController) {
    soundController.addEventListener('click', function() {
        if (isSoundPlay) {
            videoBackground.muted = true
            soundController.innerHTML = 'Sound Off'
        } else {
            videoBackground.muted = false
            soundController.innerHTML = 'Sound On'
        }
        isSoundPlay = !isSoundPlay
    })
}