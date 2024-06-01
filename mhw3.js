function displayMenu(event)
{
    let main = document.querySelector('main');
    let footer = document.querySelector('footer');
    let menu = document.querySelector('#menu');

    let first_ban = document.querySelector('#hamburger [data-index="1"]');
    let ham = document.querySelector('#hamburger [data-index="2"]');
    let last_ban = document.querySelector('#hamburger [data-index="3"]');

    let explanation = document.createElement("p");
    explanation.textContent = "Yes, I Know, I was supposed to create the menù, but let's be real, at the end of the day, it doesn't matter";
    
    if(flag === 0){
        flag = 1;
        main.classList.add('hidden');
        footer.classList.add('hidden');
        menu.classList.remove('hidden');

        first_ban.classList.add('change');
        ham.classList.add('change');
        last_ban.classList.add('change');

       
        menu.appendChild(explanation);
        console.log("menù aperto");
    }
    else{
        flag = 0;
        main.classList.remove('hidden');
        footer.classList.remove('hidden');
        menu.classList.add('hidden');

        first_ban.classList.remove('change');
        ham.classList.remove('change');
        last_ban.classList.remove('change');

        menu.innerHTML='';

        console.log("menù chiuso");
    }
}

function reality()
{
    introductionWallpaper.style.backgroundImage = "url(1000YardStare.jpg)";
    /*
    introductionWallpaper.style.backgroundSize = "cover";
    introductionWallpaper.style.backgroundPosition = "center";
    */
}


function expectations()
{
    introductionWallpaper.style.backgroundImage = "url(https://hips.hearstapps.com/hmg-prod/images/soldier-of-the-us-army-1st-raider-brigade-walks-past-tanks-news-photo-1694456644.jpg?crop=0.88932xw:1xh;center,top&resize=1200:*)";
}


let flag = 0;
const menu = document.querySelector('#hamburger');
menu.addEventListener('click', displayMenu);


const rabbitHole = document.querySelector('#introduction a');
const introductionWallpaper = document.querySelector('#introduction');
rabbitHole.addEventListener('mouseover', reality);
rabbitHole.addEventListener('mouseout', expectations);

function onJson(json) {
    console.log('JSON ricevuto');
    console.log(json);
  
    const library = document.querySelector('#album-view');
    library.innerHTML = '';
  
    const results = json.tracks.items;
    let num_results = results.length;

    console.log(num_results);
  
    for(let i=0; i<num_results; i++)
    {
      console.log(results[i]);
      const album_data = results[i]
  
      const title = album_data.name;
      const selected_image = album_data.album.images[0].url;
  
      const data_pubblicazione = document.createElement('p');
      data_pubblicazione.textContent = 'questo contenuto è stato rilasciato in data ' + album_data.release_date;
      const num_brani = document.createElement('p');
      num_brani.textContent = 'questo album è composto da ' + album_data.total_tracks + " brani";
      
      const album = document.createElement('div');
      album.classList.add('album');
  
      const img = document.createElement('img');
      img.src = selected_image;
  
      const caption = document.createElement('span');
      caption.textContent = title;
  
      album.appendChild(img);
      album.appendChild(caption);
  
      album.appendChild(data_pubblicazione);
      album.appendChild(num_brani);
      library.appendChild(album);
    }
  }
  
  function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
  }
  
  function search(event)
  {
    event.preventDefault();
    
    const album_input = document.querySelector('#album');
    const album_value = encodeURIComponent(album_input.value);
    console.log('Eseguo ricerca: ' + album_value);
  
    fetch("search_content.php?q="+encodeURIComponent(album_value)).then(onResponse).then(onJson);
    event.preventDefault();
  }
  
  function onTokenJson(json)
  {
    console.log(json)
  
    token = json.access_token;
  }
  
  function onTokenResponse(response)
  {
    return response.json();
  }
  
  const form = document.querySelector('form');
  form.addEventListener('submit', search);


  async function fetchData(){
    try{
        const pokemonName = document.getElementById ("pokemonName").value.toLowerCase();

        const response = await fetch(`https://pokeapi.co/api/v2/pokemon/${pokemonName}`);
        
        if(!response.ok){
            throw new Error ("Could not fetch resource");
        }

        const data = await response.json();

        const pokemonSprite = data.sprites.front_default;

        const imgElement = document.getElementById("pokemonSprite");

        imgElement.src = pokemonSprite;

        imgElement.style.display = "block";
        }
        catch(error){
            console.error(error);
        }
}
