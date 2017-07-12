<template>
	<vue-event-calendar :events="jumpers"></vue-event-calendar>
</template>

<script>
// import axios from 'axios'

export default {
  data: () => ({
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

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

</style>
