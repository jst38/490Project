const searchForm = document.querySelector("form");
const searchResultDiv = document.querySelector(".search-result");
const container = document.querySelector(".container");
let searchQuery = "";
const APP_ID = "ba090757";
const APP_key = "daa20634d8472a5e8d63e245bfe22c58";

let star = document.querySelectorAll('input');
let showValue = document.querySelector('#rating-value');

for (let i = 0; i < star.length; i++) {
	star[i].addEventListener('click', function() {
		i = this.value;

		showValue.innerHTML = i + " out of 5";
	});
}







searchForm.addEventListener("submit", (e) => {
    e.preventDefault();
    searchQuery = e.target.querySelector("input").value;
    fetchAPI();
});

async function fetchAPI() {
    const baseURL = `https://api.edamam.com/search?q=${searchQuery}&app_id=${APP_ID}&app_key=${APP_key}&to=25`;
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
            <div class="food-container">
                <h1 class="title">${result.recipe.label}</h1>
                <a class="view-button" href="${result.recipe.url}" target="_blank">View Recipe</a>
            </div>
            <p class="item-data"><b>Meal Time:</b> ${result.recipe.mealType} </p>
            <p class="item-data"><b>Calories:</b> ${result.recipe.calories.toFixed(2)}</p>
            <p class="item-data"><b>Ingredients:</b> ${result.recipe.ingredientLines} </p>
            <p class="item-data"><b>Nutrition Facts:</b></p>
            
            <ul>
            <p class="item-data"><b><li>Carbs</li></b> ${result.recipe.totalNutrients.CHOCDF.quantity.toFixed(2)}</p>
            <p class="item-data"><b><li>Fat</li></b> ${result.recipe.totalNutrients.FAT.quantity.toFixed(2)}</p>
            <p class="item-data"><b><li>Protein</li></b> ${result.recipe.totalNutrients.PROCNT.quantity.toFixed(2)}</p>
            </ul>

            <div class="rating-wrap">
			<h2>Rating</h2>
			<div class="center">
				<fieldset class="rating">
					<input type="radio" id="star5" name="rating" value="5"/><label for="star5" class="full" title="Awesome"></label>
					<input type="radio" id="star4.5" name="rating" value="4.5"/><label for="star4.5" class="half"></label>
					<input type="radio" id="star4" name="rating" value="4"/><label for="star4" class="full"></label>
					<input type="radio" id="star3.5" name="rating" value="3.5"/><label for="star3.5" class="half"></label>
					<input type="radio" id="star3" name="rating" value="3"/><label for="star3" class="full"></label>
					<input type="radio" id="star2.5" name="rating" value="2.5"/><label for="star2.5" class="half"></label>
					<input type="radio" id="star2" name="rating" value="2"/><label for="star2" class="full"></label>
					<input type="radio" id="star1.5" name="rating" value="1.5"/><label for="star1.5" class="half"></label>
					<input type="radio" id="star1" name="rating" value="1"/><label for="star1" class="full"></label>
					<input type="radio" id="star0.5" name="rating" value="0.5"/><label for="star0.5" class="half"></label>
				</fieldset>
			</div>

			<h4 id="rating-value"></h4>
		</div>
            
        </div>
        `
    })
    searchResultDiv.innerHTML = generatedHTML;
}


//.length < 5 ? result.recipe.ingredients : "See recipe for ingredients."
