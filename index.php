<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    

    <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");

:root {
  --primary-color: hsl(214, 30%, 95%);
  --secondary-color: #0669ac;
  --white: #f7f7f7;
  --max-width: 1500px;
  background-image: url("assets/Background\ image\ Universty.jpg"); 
  background-repeat: no-repeat; 
  background-position: center; 
  background-size: cover; 
  
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
  
}

body {
  font-family: "Poppins", sans-serif;
}

nav {
  max-width: var(--max-width);
  margin: auto;
  padding: 1rem;
  height: 90px;
  display: flex;
  align-items: center;
  justify-content: space-between;

}

.nav__logo img {
  margin-left: 20px;
  width: 220px;  /* Adjust width */
  height: 120px;  /* Adjust height */
}


.nav__links {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 1rem;
}

.link a {
  padding: 0;
  font-size: 1.0rem;
  font-weight: 500;
  color: var(--text-color);
  text-decoration: none;
  transition: 0.3s;
  border: 2px solid var(--white);
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}

.link a:hover {
  color: var(--primary-color);
}

.link .nav__btn {
  padding: 1rem 4rem;
  color: var(--white);
  border-radius: 5px;
}

.link .nav__btn:hover {
  background-color:var(--secondary-color)
}

.link {
  position: relative;
}

.dropdown {
  display: none;
  position: absolute;
  top: 160%;
  left: 0;;
  box-shadow: 0 8px 16px;
  z-index: 1;
  min-width: 200px;
  border-radius: 5px;
  overflow: hidden;
}

.dropdown a {
  padding: 1rem;
  font-size:12px;
  font-weight: 500;
  display: block;
  text-decoration: none;
  color: var(--white);
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
  transition: 0.3s;
}

.dropdown a:hover {
  background-color: var(--white);
  color: var(--secondary-color);
}

.link:hover .dropdown {
  display: block;
}


.container {
  max-width: var(--max-width);
  margin: auto;
  padding: 0.5rem;
  min-height: calc(100vh - 100px);
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 4rem;
}

.content__container {
  display: flex;
  flex-direction: column;
  justify-content: center;
  padding-left:50px;
}

.content__container h1 {
  font-size: 3.5rem;
  font-weight: 400;
  line-height: 4rem;
  color: var(--white);
  margin-bottom: 1rem;
}

.heading__1 {
  font-weight: 700;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}

.content__container p {
  font-size: 0.9rem;
  color: var(--white);
  margin-bottom: 2rem;
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
}

.learn-more-wrapper {
  text-align: left; 
  margin-top: 2rem;
  margin: left 0;; 
}

.learn-more-btn {
  color: var(--white); 
  padding: 1rem 2rem; 
  border: 2px solid var(--white);
  border-radius: 5px; 
  font-size: 1rem; 
  text-decoration: none; 
  transition: 0.3s; 
  text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
  
}

.learn-more-btn:hover {
  background-color: var(--white);
  color: var(--secondary-color);
}
</style>
<title>WayaSync | Home Page</title>
   
  </head>
  <body>
    
    <nav>
      <div class="nav__logo">
        <image src="assets/images/logo.png">
      </div>
      <ul class="nav__links">
        
        <li class="link"><a href="#" class="nav__btn"><strong>Login</strong></a>
          <div class="dropdown">
            <a href="student-login.php"><strong>Student</strong></a>
            <a href="teacher-login.php"><strong>Lecturer</strong></a>
            <a href="Instructor-login.php"><strong>Sport Instructor</strong></a>
          </div>
        </li>
      
      </ul>
    </nav>
    <section class="container">
      <div class="content__container">
        <h1>
          <span class="heading__1">WayaSync<br> Lecture-Free <br> Request System</span><br />
          
        </h1>
        <p>
          Forget paper, dominate your schedule! 
          Click, submit your absence, <br>track it live
          and crush your next practice. 
          This system saves time, <br>keeps teachers informedand lets you focus on winning <br> both in academics and athletics!
        </p>
        <div class="learn-more-wrapper">  <a href="learn-more.html" class="learn-more-btn"><strong>Learn More</strong></a>
        </div>
        
      </div>
    </section>
    <script>
// scripts.js

document.addEventListener('DOMContentLoaded', function() {
  const navBtn = document.querySelector('.nav__btn');
  const dropdown = document.querySelector('.dropdown');

  navBtn.addEventListener('click', function(event) {
    event.preventDefault();
    dropdown.classList.toggle('show');
  });

  window.addEventListener('click', function(event) {
    if (!event.target.matches('.nav__btn')) {
      if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
      }
    }
  });
});

  
    </script>

  </body>
</html>
