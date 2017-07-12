<template>
  <div>
    <Addmemodal></Addmemodal>
  	<vue-event-calendar :events="jumpers"></vue-event-calendar>
  </div>
</template>

<script>
// import axios from 'axios'

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
    jumpers: [
      {
        date: '2017/07/19',
        title: 'test 1',
        desc: 'hello world',
        role: 'pilot'
      },
      {
        date: '2017/07/21',
        title: 'Test 2',
        desc: 'hello world',
        role: 'pilot'
      },
      {
        date: '2017/07/21',
        title: 'Matti esko',
        desc: 'hello world',
        role: 'student'
      },
      {
        date: '2017/07/19',
        title: 'Test 2',
        desc: 'hello world',
        role: 'licensed'
      },
      {
        date: '2017/07/19',
        title: 'Test 2',
        desc: 'hello world',
        role: 'licensed'
      },
      {
        date: '2017/07/19',
        title: 'Test 2',
        desc: 'hello world',
        role: 'licensed'
      }
    ]
  })
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

</style>
