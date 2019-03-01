/*
if (document.body === null) {
	alert("Le DOM n'est pas construit !");
	"use strict";
} else {
	alert("Le DOM est construit");
}
*/

let para = document.getElementById("paragraphe");
para.style.color="red";
console.log(para.childNodes);
console.log(para.children);

let li = document.querySelectorAll("li");
console.log(li.length);

let u = document.querySelectorAll("ul li");
console.log(u.length);

let liste1 = document.querySelector("#liste1");
console.log(liste1.childNodes.length);

let liste2 = document.querySelector("#liste2");
console.log(liste2.childNodes.length);

console.log(liste1.children.length);
console.log(liste2.children.length);

console.log(liste1.firstElementChild);
console.log(liste1.lastElementChild);

console.log(liste2.firstChild);
console.log(liste2.lastChild);

let leg = document.querySelector("figcaption");
leg.style.color="red";

let lp = document.querySelectorAll("body p");

lp[lp.length-1].style.fontSize="40px";

let img = document.querySelector("img");
console.log(img.src);
