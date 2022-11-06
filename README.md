<a name="readme-top"></a>

<img src="https://user-images.githubusercontent.com/82551484/194697977-541e32ae-d298-472c-9534-ccf6d385accc.png" align="right" />

# CoffeeShop-Website</br>
![Issues](https://img.shields.io/github/issues/lynnaouad/CoffeeShop-Website)&nbsp;
![Stars](https://img.shields.io/github/stars/lynnaouad/CoffeeShop-Website)&nbsp;
![Contributors](https://img.shields.io/github/contributors/lynnaouad/CoffeeShop-Website)&nbsp;
![Forks](https://img.shields.io/github/forks/lynnaouad/CoffeeShop-Website)

> Welcome aboard fellow developer, this is where you will find projects which you are free to contribute to. You can contribute by submitting your own scripts, which you think would be amazing for other people to see. 

## Description
Responsive website that sells coffee, juices, smoothies and milkshakes.<br><br>

***Main functions of the website:***
<ul>
  <li>Display offers section, about section (photos of happy customers, information about the team).</li>
  <li>Display menu in categories (coffee, smoothies, juices...)</li>
  <li>Display extra Toppings (chocolate, fruits...)</li>
  <li>Display customers reviews and rate statistics.</li>
  <li>Customer can change currency to $, LBP, EUR ...</li>
  <li>Customer can add item into wishlist.</li>
  <li>Customer can place order.</li>
</ul><br>
 
***Admin Side:***
<ul>
  <li>Admin can add another admin, manager and team member.</li>
  <li>Admin/Manager can view all statistics and reports (reviews, orders, revenue, customers...)</li>
  <li>Admin/manager can add a new currency and change delivery cost</li>
  <li>Manager can manage menu items, toppings items, add or remove offers...</li>
</ul>

## Live Demo
https://coffee-shop2022.000webhostapp.com/  <br>
https://coffee-shop2022.000webhostapp.com/admin_panel/

## Built With

* [![HTML5][HTML5.com]][HTML5-url]
* [![CSS3][CSS3.com]][CSS3-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![JS][JS.com]][JS-url]
* [![JQuery][JQuery.com]][JQuery-url]
* [![PHP][PHP.com]][PHP-url]
* [![MYSQL][MYSQL.com]][MYSQL-url]

**Plugins:**<br>
<ul>
  <li>aos-2.3.4</li>
  <li>chart.js-3.7.1</li>
  <li>iconify-2.1.2</li>
  <li>sweetalert2</li>
  <li>swiper-8.0.7</li>
</ul><br>

  
## Installation

Download the project from github to your desktop:

  - **With Git** :
      If you’re familiar with git and have it installed on your computer, you can clone the repository to download the files.
      
      **1.** Click the green button labeled &nbsp;`Code`</br>
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194698853-75cf149f-b2cb-4e89-ab14-95b9a0324445.png" width="300px;" /></br>
      
      **2.** Copy the URL of the repository</br>
      
      **3.** Next, on your local machine, open your bash shell and change your current working directory to the location where you would like to clone your repository
      ```shell
      cd "path-to-your-folder"
      ```
      
      **4.** Once you have navigated to the directory where you want to put your repository, you can use
      ```shell
      git clone https://github.com/lynnaouad/CoffeeShop-Website.git
      ```
      
      **5.** When you run `git clone https://github.com/lynnaouad/CoffeeShop-Website.git`, You should see output like
      ```shell
      Cloning into 'test-repo'...
      remote: Counting objects: 5, done.
      remote: Compressing objects: 100% (4/4), done.
      remote: Total 5 (delta 0), reused 0 (delta 0), pack-reused 0
      Unpacking objects: 100% (5/5), done.
      Checking connectivity... done.
      ```
      </br>
      
  - **Without Git** :
      When downloading materials to your laptop, it is easiest to download the entire repository.
      
      **1.** Click on the green `Code` button, then download the repository as a ZIP file</br>
      
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194698883-4b94312d-4537-48d2-ae16-84b807120605.png" width="350px;" /></br>
      
      **2.** Find the downloaded .zip file on your computer, likely in your Downloads folder</br>
      
      **3.** Unzip it, this will create a folder named after the GitHub repository</br></br>

  - **Steps you must do to make the app work properly** :
      
      `Note:` Please Make sure that PHP/mysqli version is 7.4+, so that the project can run without any possible errors. <br><br>
      
      **1.** You must have `XAMPP` or `WAMPP` web server.<br>
      
      **2.** Create a new directory named 'project' in: `C:\xampp\htdocs` and **export** your CoffeShop project there.<br><br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194700099-8706612f-13cc-4cc9-9de8-f88426c24da2.png" width="300px;" /></br>
      
      
      **3.** In PhpMyAdmin:<br>
      - Create Database named: `coffeeshop`
      - Import `coffeeshop.sql` file from Database folder.<br>
         
      **4.** Database Connection: If you have a specific `username` or `password` update database connection: `includes\db_connect.php` <br>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194699715-198b6ccb-5d43-4ea4-b785-f9f07ce9e18a.png" width="500px" /></br>  
      
      **5.** Open your project: `http://localhost/CoffeShop`
 
      
<p align="right">(<a href="#readme-top">back to top</a>)</p> <br>


## Database
<img src="https://user-images.githubusercontent.com/82551484/194751431-ac416db5-6a8a-4770-994e-94953f6271d7.jpeg" > <br>


## CoffeeShop Website:

- **Welcome Page:** <br>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194729462-57e2b6f6-bceb-44b1-b269-5499b0fd704a.gif" /></br>
<br>

- **Offers Section:**<br>
<img src="https://user-images.githubusercontent.com/82551484/194728627-d505cdc9-a6e6-4e13-acca-5f6145af0ed6.png" /><br>
<img src="https://user-images.githubusercontent.com/82551484/194729012-a54dd691-1960-4638-b9be-c0e961ed0f40.png" /><br>
<br>

- **About Section:**<br>
<img src="https://user-images.githubusercontent.com/82551484/194728721-0774cfb7-caba-4ce4-aba8-47f90d063ba8.png" /></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194729495-81cf0292-3cd9-4d1c-a1db-08d492e1995f.gif" /></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194729501-a6f0a3d9-5981-44e1-97fe-be9e79838c0c.gif" /></br>
<br>

- **Menu Section:**<br>
<img src="https://user-images.githubusercontent.com/82551484/194729140-6500ebaa-8caf-4ac6-98e7-233318d8f736.png" /></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194729578-6624c6ef-84cb-4708-9ab1-144447a6ec21.gif" /></br>
           
`Note` We can add item into to wishlist.<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194729537-4c34550b-b337-4f57-a53e-20f4ecba7bac.gif" /><br>    
<img src="https://user-images.githubusercontent.com/82551484/194728631-8060c7ef-aa5e-481d-aebf-e09c4f644540.png" /><br>
                                                                                                            
`Note` We can change the currency.<br>
<img src="https://user-images.githubusercontent.com/82551484/194729209-9e110433-88a9-42f0-92de-0a1d9f479a07.png" /><br>
<br>

- **Toppings Section:**<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194729605-200417f8-94dd-4a91-bd79-21468f269931.gif" /></br>   
<img src="https://user-images.githubusercontent.com/82551484/194728925-5ed5558b-cc97-4422-bfbb-d66a4c219cc7.png" /></br>
<img src="https://user-images.githubusercontent.com/82551484/194728930-c130fc66-f0be-4d82-bf3c-4abd3101f133.png" /></br>
<br>                                                                                                            

- **Reviews Section:**<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="https://user-images.githubusercontent.com/82551484/194730014-7cd12cab-a2cf-425b-8a9f-16d4efda2aed.jpg" ><br>     
<img src="https://user-images.githubusercontent.com/82551484/194729181-c04c6997-fd24-46b0-9827-c7dc665765b8.png" ><br>
<br>                                                                                                           

- **Place Order:**<br>
<img src="https://user-images.githubusercontent.com/82551484/194729428-e9bbf755-e85c-41d8-bf0a-542826e41eb4.png" ><br>
<img src="https://user-images.githubusercontent.com/82551484/194729434-82854cf7-ff3e-45e3-a669-0b723248cf6f.png" ><br>

- **Responsive:**<br>
<img height="500px" src="https://user-images.githubusercontent.com/82551484/194755770-3246d405-eff8-4cb7-8aa1-7ae3f4e8b679.gif" ><br>

<br>

https://user-images.githubusercontent.com/82551484/200152314-7eaa88a0-a1c5-44a4-97f2-a939e2856c3f.mp4

<br>

## Administrator Panel 
`Note` the video is available in **CoffeeShop-Website/Videos**.<br>


<video src="https://user-images.githubusercontent.com/82551484/194755345-50d2b304-1cb4-4e46-b32a-c41c291411ac.mp4" ></video>

<br>

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Instructions

- Fork this repository
- Clone your forked repository
- Add your scripts
- Commit and push
- Create a pull request
- Star this repository
- Wait for pull request to merge
- Celebrate your first step into the open source world and contribute more

<p align="right">(<a href="#readme-top">back to top</a>)</p>



## License

Distributed under the MIT License. See [`LICENSE`](https://github.com/lynnaouad/CoffeeShop-Website/blob/main/LICENSE.md) for more information.  
Copyright © 2022, Lynn Aouad

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Contact

- Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;[lynn.aouad@outlook.com](mailto:lynn.aouad@outlook.com)

- Project Link : &nbsp;[https://github.com/lynnaouad/CoffeeShop-Website](https://github.com/lynnaouad/CoffeeShop-Website)

<p align="right">(<a href="#readme-top">back to top</a>)</p>



## Additional tools to help you get Started with Open-Source Contribution

* [How to Contribute to Open Source Projects – A Beginner's Guide](https://www.freecodecamp.org/news/how-to-contribute-to-open-source-projects-beginners-guide/)
* [How to Write a Good README File for Your GitHub Project](https://www.freecodecamp.org/news/how-to-write-a-good-readme-file/)

#### Note: When you add a project, add it to the README for ease of finding it.
#### Note: Please do not have the project link reference your local forked repository. Always link it to this repository after it has been merged with main.

<p align="right">(<a href="#readme-top">back to top</a>)</p>



[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com
[JQuery.com]: https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white
[JQuery-url]: https://jquery.com 
[HTML5.com]: https://img.shields.io/badge/HTML5-ff7340?style=for-the-badge&logo=html5&logoColor=white
[HTML5-url]: https://html5.com 
[CSS3.com]: https://img.shields.io/badge/CSS3-4A4A55?style=for-the-badge&logo=css3&logoColor=61DAFB
[CSS3-url]: https://css3.com 
[JS.com]: https://img.shields.io/badge/JS-EBE663?style=for-the-badge&logo=javascript&logoColor=black
[JS-url]: https://javascript.com 
[PHP.com]: https://img.shields.io/badge/PHP-ff2814?style=for-the-badge&logo=php&logoColor=61DAFB
[PHP-url]: https://php.com 
[MYSQL.com]: https://img.shields.io/badge/MYSQL-000000?style=for-the-badge&logo=mysql&logoColor=white
[MYSQL-url]: https://mysql.com 

