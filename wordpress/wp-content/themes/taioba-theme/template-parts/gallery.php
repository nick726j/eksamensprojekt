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
	<!-- <---------------- STYLING (POPOP) ------------------>
  <style>
#popop {
  display: none;
  position: fixed;
  left: 0;
  top: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.7);
  overflow: scroll;
  border: solid 2px black;
}

#popop-article {
  display: flex;
  flex-direction: row;
  justify-content: center;
  padding: 1em;
  width: fit-content;
  margin: auto;
  background-color: #ffffff;
  height: fit-content;
  box-shadow: none;
}
</style>
<!-- <---------------- STYLING (POPOP) ------------------>


<!-- <---------------- POPOP ------------------>
      <section id="popop">
        <article id="popop-article" class="article">
          <section class="popop">
            <img class="img" src="" alt="" />
            <p class="artist"></p>
          </section>
        </article> 
<!-- <div id="popop">
    <article>
      <img src="" alt="" />
      <p></p>
    </article>
  </div> -->
<!-- <---------------- POPOP ------------------>

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

function addEventListenersToButtons(){
  document.querySelectorAll("#filtrering button").forEach(elm =>{
    elm.addEventListener("click", filtrering);
  })
}

function filtrering(){
filterTattoo = this.dataset.tattoo;
console.log(filterTattoo);

visTattoos();
}

function visTattoos() {
  let temp = document.querySelector("template");
  let container = document.querySelector(".tattoocontainer");
  container.innerHTML = "";
  tattoos.forEach((tattoo) => {
if(filterTattoo == "alle" || tattoo.categories.includes(parseInt(filterTattoo))){
      let klon = temp.cloneNode(true).content;
      klon.querySelector("img").src = tattoo.billede.guid;
      klon.querySelector(".artist").textContent = tattoo.artist;
	//   Er det denne kode, der f
          klon
        .querySelector("article")
        .addEventListener("click", () => visTattoo(tattoo));
      container.appendChild(klon);
	  
}
  })
 
}

// --------------------------- POPOP -------------------------//
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
// --------------------------- POPOP -------------------------//

getJson();

	</script>
</main>

	<?php
endwhile;
