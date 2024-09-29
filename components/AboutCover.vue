<template>
    <header>

      <div class="background-image" />
      <img src="/pages/assets/about.png" alt="Bottom image" class="bottom-image">
      <div class="mask"></div>
      <div class="banner-container">
      </div>
    </header>
  </template>
  
  <style scoped>
    .background-container {
      position: absolute;
      bottom: 0;
      right: 0;
      display: flex;
      align-items: flex-end;
    }
  
    .background-image {
      background-size: cover;
      background-position: center;
      background-color: #ff8100;
      height: 100vh;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1; 
      border-radius: 0 0 50px 50px;
    }
  
    .background-image::after {
      content: "";
      position: absolute;
      bottom: 0; 
      left: 50%; 
      transform: translateX(-50%); 
      width: 50px; 
      height: 50px;
      border-radius: 50%;
      background-color: #fff; 
      z-index: 1; 
    }
  
    .upper-image {
      width: 50%;
      position: absolute;
      opacity: 0.6;
      left: 30%; 
      transform: matrix(0.98, 0.18, -0.31, 0.95, 0, 0);
      margin-top: -15%;
    }
  
    @media only screen and (max-width: 1084px) {
      .upper-image {
        top: 0;
      }
    }
  
    .bottom-image {
      position: absolute;
      margin-top: 20px;
      bottom: -100px;
      left: 50%;
      transform: translateX(-50%);
      width: 200px;
      height: 200px;
  
      border: 20px solid #ff8100; 
      border-radius: 50%;
    }
  
    .photo-banner{
      position: absolute;
      bottom: 0px; /* add some margin to the bottom */
      right: 0px; /* add some margin to the right */
      width: 100vh;
      height: 90vh;
      object-fit: cover;
      z-index: -1;
    }
  
    .banner-image {
      position: absolute;
      height: 100px;
      width: 100px;
      bottom: 50%; /* add some margin to the bottom */
      right: 100px;
      margin-left: 20px;
    }
  
    @media only screen and (max-width: 710px) {
      .banner-image {
        display: none;
      }
    }
  </style>