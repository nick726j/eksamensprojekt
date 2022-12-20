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
	?>

<main id="content" <?php post_class( 'site-main' ); ?> role="main">

<template>
    <article>
      <img src="" alt="" />
      <p class="artist"></p>
    </article>
</template>
	
<!-- <---- POPOP ---->
 <div id="popop">
    <article>
      <img src="" alt="" />
      <p></p>
    </article>
  </div>
<!-- <---- POPOP ---->

<main>
  <nav id="filtrering">
    <button data-tattoo="alle">Alle</button>
  </nav>
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
      klon.querySelector(".artist").textContent = tattoo.artist;
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
