const searchForm = document.querySelector("form");
const searchResultDiv = document.querySelector(".search-result");
const container = document.querySelector(".container");
let searchQuery = "";
const APP_ID = "ba090757";
const APP_key = "daa20634d8472a5e8d63e245bfe22c58";

searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
    searchQuery = e.target.querySelector("input").value;
    fetchAPI();
});

async function fetchAPI() {
    const baseURL = `https://api.edamam.com/search?q=${searchQuery}&app_id=${APP_ID}&app_key=${APP_key}&to=10`;
    const response = await fetch(baseURL);
    const data = await response.json();
    generateHTML(data.hits);
    console.log(data);
} 
function generateHTML(results){
    container.classList.remove('initial');
    let generatedHTML = '';
    results.map(result => {
        generatedHTML +=
        `
        <div class="item">
            <img src="${result.recipe.image}" alt="">
            <div class="flex-container">
                <h1 class="title">${result.recipe.label}</h1>
                <a class="view-button" href="${result.recipe.url}" target="_blank">View Recipe</a>
            </div>
            <p class="item-data"><b>Calories:</b> ${result.recipe.calories.toFixed(2)}</p>
            <p class="item-data"><b>Ingredients:</b> ${result.recipe.ingredientLines} </p>
            <p class="item-data"><b>Nutrition Facts:</b></p>
            
            <ul>
            <p class="item-data"><b><li>Carbs</li></b> ${result.recipe.totalNutrients.CHOCDF.quantity.toFixed(2)}</p>
            <p class="item-data"><b><li>Fat</li></b> ${result.recipe.totalNutrients.FAT.quantity.toFixed(2)}</p>
            <p class="item-data"><b><li>Protein</li></b> ${result.recipe.totalNutrients.PROCNT.quantity.toFixed(2)}</p>
            </ul>

            <p class="item-data"><b>Type of Dish:</b> ${result.recipe.cuisineType} </p>
            
        </div>
        `
    })
    searchResultDiv.innerHTML = generatedHTML;
}


//.length < 5 ? result.recipe.ingredients : "See recipe for ingredients."