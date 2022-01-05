<main class="mainhome vh-100">
<div class="hero">
    <div class="p-3 hero-text container text-white">
      <span class="spanhero text-center">
        <h1>De beste videokaarten van Nederland!</h1>
        <p>Bekijk ons assortiment videokaarten hier.</p>
        <div class="homepagecta">
         <a class="homepagecta btn btn-primary" href='/product'>Bekijk de videokaarten</a>
        </div>
      </span>
    </div>
  </div>
  <canvas id="canvas3d"></canvas>
    <script defer type="module">
        import { Application } from './scripts/homepageanimation/runtime.js';
        const app = new Application();
        app.load('./scripts/homepageanimation/scene.json');
    </script>
</main>
