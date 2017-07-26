<template>
  <div>
    <Addmemodal></Addmemodal>
  	<vue-event-calendar :events="jumpers"></vue-event-calendar>
  </div>
</template>

<script>
import axios from 'axios'
import Addmemodal from './addmemodal.vue'

export default {
  components: { Addmemodal },
  data: () => ({
    showModal: false,
    roles: [
      'pilot',
      'licensed',
      'student'
    ],
    jumpers: []
  }),
  methods: {
    getJumpers () {
      console.log('requesting jumpers')
      axios.get('./static/api/jumpers/list')
      .then(response => {
        this.jumpers = response.data
        console.log(response.data)
      })
      .catch(e => {
        this.errors.push(e)
      })
    }
  },
  created () {
    console.log('this is crated!')
    this.getJumpers()
    /*
      Using setInterval causes calendar to pop up to 'all' view, eg. unselecting any day selected when data is updated. need to fix
      setInterval(this.getJumpers, 10000)
    */
  }
}

</script>
<style>

.jumper-list {
  margin-top:10px;
  height:auto;
  background-color:#fff;

  border-radius:10px;
}

.single-jumper {
  padding:10px;
  color:#000;
}
.wrapper{text-align:left;padding:5px;}

.pilot-yes{border:3px solid #55aed0!important;}
.licensed-yes{background-color:#afa!important;}
.student-yes:after{content:"";background-color:red;border-radius:100%;width:12px;height:12px;position:absolute;right:-3px;top:-3px;}

</style>
