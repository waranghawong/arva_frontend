import Aos from 'aos';
import 'aos/dist/aos.css';

export default defineNuxtPlugin((nuxtApp) => {
  nuxtApp.AOS = Aos.init({
    delay: 200,
  });
});