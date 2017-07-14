<template>
  <div class='guide'>
    <h1>Hello world</h1>
    <p>Tässä vähän ohjeita, lueskeles vaan.</p>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data () {
    axios.get('./static/api/jumpers/list')
    .then(function (response) {
      console.log(response)
    })
    return {
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>


</style>
