<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
  the_content();
	?>
<main id="content" <?php post_class( 'site-main' ); ?> role="main">

<template>
    <article class="article-tattoos">
      <img src="" alt="" />
      <p class="artist"></p>
    </article>
</template>

	<!-- <---------------- STYLING (POPOP) ------------------>
  <style>
    main {
max-width: 1140px;
    margin-left: auto;
    margin-right: auto;    }
#popop { /* Pop-up-vinduet åbnes, når der klikkes på en person */
  display: none; /* Pop-up-vinduet er som udgangspunk lukket */
  position: fixed; /* Pop-up-vinduet er det samme sted - også selvom der bliver scrollet*/
  justify-content: center; /* Inhold i pop-up-vinduet er centreret */
  align-items: center; /* Inhold i pop-up-vinduet er centreret */
  top: 0; /***** Selve pop-up-vinduet er placeret i midten af skærmen *****/
  bottom: 0;
  left: 0;
  right: 0; /**** Selve pop-up-vinduet er placeret i midten af skærmen ****/
  width: 100vw; /* Pop-up-vinduet fylder hele skærmen */
  height: 100vh;/ /* Pop-up-vinduet fylder hele skærmen */
  background-color: rgba(0, 0, 0, 0.7); /* Baggrunden rundt om pop-up-vinduet er bliver mørk, men gennemsigtig */
  border: solid 2px black; /* Giver pop-up-vinduet en ramme */
}

#popop article { /*Pop-up-vinduets indhold */
  display: flex; 
  justify-content: center;
  flex-direction: column;
  padding: 1em;
  width: fit-content;
  margin: auto;
  background-color: #F2F0EB;
  height: fit-content;
  box-shadow: none;
}
#popop article p {
font-size: 2rem;
}
button {
display: inline-block;
    font-weight: 400;
    color: #291E10;
    text-align: center;
    white-space: nowrap;
    border: none;
    padding: 1.5rem 1rem;
    font-size: 1.2rem;
}
button:hover {
    background-color: transparent;
    color: #291E10;
    text-decoration: underline;
    font-weight: bold;
}
nav :first-child {
  padding-right: 2rem; 
}
button:active, button:focus {
    background-color: transparent;
    color: #291E10;
    text-decoration: underline;
        font-weight: bold;
}
.tattoocontainer {
    gap: 30px;
    columns: 4;
    column-gap: 15px
}
@media only screen and (max-width: 768px) {
  /* For mobile phones: */
.tattoocontainer {
    gap: 30px;
    columns: 2;
    column-gap: 15px
}
  }

 .article-tattoos {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        height: fit-content;
    margin-bottom: 15px;
 }
.navbar h3 {
     padding-right: 1.5rem;
}
  .navbar {
        display: flex;
          border-bottom: 2px solid black;
    margin-bottom: 8%;
    align-items: center


      }
</style>
<!-- <---------------- STYLING (POPOP) SLUT ------------------>


<!-- <---------------- POPOP ------------------>
<div id="popop">
    <article>
      <img src="" alt="" />
      <p></p>
    </article>
  </div>
<!-- <---------------- POPOP SLUT ------------------>

<main>
  <div class="navbar">
  <h3>Sort by artist:</h3>
  <nav id="filtrering">
    <button data-tattoo="alle">Alle</button>
  </nav>
</div>
  <section class="tattoocontainer">
  </section>
</main>


	<script>
    let tattoos;
    let categories;
    let filterTattoo = "alle";
    
    const url = "https://apmedia.dk/kea/eksamensprojekt/wordpress/wp-json/wp/v2/tattoo?per_page=100";
    const catUrl = "https://apmedia.dk/kea/eksamensprojekt/wordpress/wp-json/wp/v2/categories";

// Her hentes json data ind og sendes videre til funktionen visTattoos og opretKnapper
async function getJson() {
  const data = await fetch(url);
  const catData = await fetch(catUrl);
  tattoos = await data.json();
  categories = await catData.json();
 console.log(categories);
  visTattoos();
  opretKnapper();
}

function opretKnapper(){
  categories.forEach(cat => {document.querySelector("#filtrering").innerHTML += `<button class="filter" data-tattoo="${cat.id}">${cat.name}</button>`}
  )
  addEventListenersToButtons();
}

// Funktion der lægger en eventlistener på alle filtreringsknapper
function addEventListenersToButtons(){
  document.querySelectorAll("#filtrering button").forEach(elm =>{
    elm.addEventListener("click", filtrering);
  })
}

// Funktion der filtrer indholdet på siden, alt efter hvilken knap der er klikket på
function filtrering(){
filterTattoo = this.dataset.tattoo;
console.log(filterTattoo);
visTattoos();
}

// visTattoos sætter hver enkel tattoo ind i html
function visTattoos() {
  let temp = document.querySelector("template");
  let container = document.querySelector(".tattoocontainer");
  container.innerHTML = ""; 
  tattoos.forEach((tattoo) => { //Arrayet tattoos loopes igennem, og hver tattoo indsættes i html
    if(filterTattoo == "alle" || tattoo.categories.includes(parseInt(filterTattoo))){
      let klon = temp.cloneNode(true).content; //html template klones og fyldes med indhold
      klon.querySelector("img").src = tattoo.billede.guid;
      klon.querySelector("article").addEventListener("click", () => visTattoo(tattoo));
      container.appendChild(klon); // Klonen tilføjes til DOM
    }
  })
}

// Når der klikkes på en tattoo vises den i en popup
 document
  .querySelector("#popop")
  .addEventListener("click", () => (popop.style.display = "none"));

function visTattoo(tattoo) {
  console.log("tattoo");
  const popop = document.querySelector("#popop");
  popop.style.display = "flex";

  popop.querySelector("img").src = tattoo.billede.guid;
  popop.querySelector("p").textContent = tattoo.artist;

}


getJson();

	</script>

</main>

	<?php
endwhile;
