
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

let submitOnInputChange = () => {
  $('.submitOnChange').on('change', function(e) {
    $(this).closest('form').submit()
  })
}

let invoiceNumberSynchroneChange = () => {
  $('.invoiceNumber').on('keyup', function(e) {
    let value = e.target.value
    let carIndex = $(this).closest('tr').find('.carIndex')[0].value;

    let some = $(this)
      .closest('form')
      .find('.carIndex')
      .filter(function(i, input) {
        return input.value === carIndex
      })
      .each(function(i, item) {
        $(item).closest('tr').find('.invoiceNumber')[0].value = value
      });
  })
}

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    mounted () {
      submitOnInputChange();
      invoiceNumberSynchroneChange();
    }
});
