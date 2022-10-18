//User location variable with default troy
let unit = "&units=imperial"
let openWeatherURL = "https://api.openweathermap.org/data/2.5/weather?lat=42.7284&lon=-73.6918&appid=061d0036468e8987fe096615b3e585cb" + unit;
//variables to display on the weather app
let city = null;
let temp = 0;
let high = 0;
let low = 0;
let feel = 0;
let humidity = 0;
let pressure = 0;
let sunrise = null;
let sunset = null;
let weatherArray = null;
let weather = null;
let windSpeed = 0;
let weatherIcon = null;
let visibility = 0;
// variables to display news app
let storyOne = null;
let storyTwo = null;
let storyThree = null;
let storyFour = null;
let storyFive = null;
let storySix = null;
// variables for the currency app
let currencyType = document.getElementsByClassName('currency-type');
let activeCurrency = document.getElementsByClassName('active-currency');



//on load of the window see if the browser supports geolocation
window.onload = function geolocation() {
    if (navigator.geolocation) {
        //if it does ask for permisson and get coords
        navigator.geolocation.getCurrentPosition(getLocation);
    } else {
        //if not alert and use default coords
        alert("Browser does bot support Geolocation");
        getWeatherData();
    }
    getWeatherData();
    getNews();
    getCurrencyExchange();
};
//get the users location and set it eqaul to the global variable
function getLocation(position) {
    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;
    openWeatherURL = "https://api.openweathermap.org/data/2.5/weather?lat=" + latitude + "&lon=" + longitude + "&appid=061d0036468e8987fe096615b3e585cb" + unit;
    getWeatherData();
}

//function to get the weather from the api
function getWeatherData() {
    $.ajax(
        {
            url: openWeatherURL,
            type: "GET",
            dataType: "jsonp",
            // if the ajax call is successful
            success: function (data) {
                //get the weather and display it
                city = data.name;
                document.getElementById('city').innerHTML = city;
                // get the temp and display it
                temp = data.main.temp;
                document.getElementById('temp').innerHTML = temp + "&deg";
                // get high temp and display it
                high = data.main.temp_max;
                document.getElementById('high-temp').innerHTML = high + "&deg";
                // get low temp and display it
                low = data.main.temp_min;
                document.getElementById('low-temp').innerHTML = low + "&deg";
                // get the feel and display it
                feel = data.main.feels_like;
                document.getElementById('real-feel').innerHTML = feel + "&deg";
                // get the humidity and display it
                humidity = data.main.humidity;
                document.getElementById('humidity').innerHTML = humidity + "%";
                // get the pressure and display it
                pressure = data.main.pressure;
                document.getElementById('pressure').innerHTML = pressure + " hPa";
                // get the sunrise time convert it from unix to US time string and display it
                sunrise = new Date((data.sys.sunrise) * 1000);
                sunrise = sunrise.toLocaleTimeString("en-US");
                document.getElementById('sunrise').innerHTML = sunrise;
                // get the sunset time convert it from unix to US time string and display it
                sunset = new Date((data.sys.sunset) * 1000);
                sunset = sunset.toLocaleTimeString("en-US");
                document.getElementById('sunset').innerHTML = sunset;
                //get the array of weahter data
                weatherArray = data.weather;
                //get the description of the weather
                weather = weatherArray[0].description;
                weatherIcon = weatherArray[0].icon;
                document.getElementById('weather-desc').innerHTML = '<img class="weather-icon pb-3" src="icons/' + weatherIcon + '.png"></img> ' + weather;
                //get the windspeed
                windSpeed = data.wind.speed;
                document.getElementById('wind-speed').innerHTML = windSpeed + " mph";
                //get visibility
                visibility = data.visibility;
                let vToKM = visibility / 1000;
                let vtoMiles = (vToKM * 0.621371192237).toFixed(2);
                document.getElementById('visibility').innerHTML = vtoMiles + " miles";

            },
            // if there was an error with ajax call
            error: function () {
                if (XMLHttpRequest.status) {
                    alert("Error: " + XMLHttpRequest.status);
                } else {
                    alert("Error: " + XMLHttpRequest.exception);
                }

            }
        }
    );
}

function getNews() {
    $.ajax(
        {
            url: "https://newsdata.io/api/1/news?apikey=pub_1223958990e7eba8fdbdeaf10104ba3ee1de6&country=us&language=en&category=technology",
            type: "GET",
            dataType: "json",
            totalResults: 10,
            success: function (data) {
                //get the first story and display it
                storyOne = data.results[0];
                displayStory(storyOne, 'story-1');
                //get the second story and display it
                storyTwo = data.results[1];
                displayStory(storyTwo, 'story-2');
                //get the third story and display it
                storyThree = data.results[2];
                displayStory(storyThree, 'story-3');
                //get the fourth story and display it
                storyFour = data.results[3];
                displayStory(storyFour, 'story-4');
                //get the fifth story and display it
                storyFive = data.results[4];
                displayStory(storyFive, 'story-5');
                //get the Sixth story and display it
                storySix = data.results[5];
                displayStory(storySix, 'story-6');
            },
            // if there was an error with ajax call
            error: function () {
                if (XMLHttpRequest.status) {
                    alert("Error: " + XMLHttpRequest.status);
                } else {
                    alert("Error: " + XMLHttpRequest.exception);
                }

            }

        }
    );


}

// function to display the stories in the html
function displayStory(aStory, storyID) {
    let link = aStory.link;
    let img = aStory.image_url;
    let pubDate = aStory.pubDate;
    let title = aStory.title;
    let description = aStory.description;
    if (img == null) {
        document.getElementById(storyID).innerHTML =
            '<a class="news-link" href="' + link + '"><p class="date-text">' + pubDate + '</p><h3 class="head-text-2">' + title + '</h3><p class="body-text">' + description + '</p></a>';

    } else {
        document.getElementById(storyID).innerHTML =
            '<a class="news-link" href="' + link + '"><img src="' + img + '" class="img-custom"><p class="date-text">' + pubDate + '</p><h3 class="head-text-2">' + title + '</h3><p class="body-text">' + description + '</p></a>';
    }

}

//function to get the currency exchange rates
function getCurrencyExchange() {
    $.ajax(
        {
            url: "https://api.frankfurter.app/latest?from=USD",
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log(data)

                document.getElementById('displayed-exchange').innerHTML = data.rates.AUD + " AUD";

                for (var i = 0; i < currencyType.length; i++) {

                    currencyType[i].addEventListener('mouseover', function () {

                        if (activeCurrency.length > 0) {
                            activeCurrency[0].classList.remove('active-currency')
                        }

                        this.classList.add('active-currency')

                        let id = this.id;

                        let newData = data.rates;

                        let currencyX = newData[id];

                        document.getElementById('displayed-exchange').innerHTML = currencyX + " " + id;
                    })
                }
            },
            // if there was an error with ajax call
            error: function () {
                if (XMLHttpRequest.status) {
                    alert("Error: " + XMLHttpRequest.status);
                } else {
                    alert("Error: " + XMLHttpRequest.exception);
                }

            }

        }
    );
}