<template>
  <div>
    <div class="addmeButton" @click="showModal = true"> + </div>

    <div v-if="showModal" id="addmemodal">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  I wanna jump too!
                </slot>
              </div>

              <div class="modal-body">
                <slot name="body">
                  
                  <input type="date" class="input" name="date"> 
                  <input type="text" class="input" name="name" placeholder="Name">  
                  <input type="text" class="input" name="notes" placeholder="notes">

                  <select name="role" class="input">
                    <option value="pilot">Pilot</option>
                    <option value="licensed">Licensed</option>
                    <option value="licensed">Student</option>
                  </select>

                </slot>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  

                  <button  type="submit" class="button btn-submit" @click="submit">
                    Submit
                  </button>

                  <button class="button btn-cancel" @click="showModal = false">
                    Cancel
                  </button>
                </slot>
              </div>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>

import axios from 'axios'

export default {
  data: () => ({
    showModal: false
  }),
  methods: {
    submit () {
      axios.post('/addJumper', {
        firstName: 'Fred',
        lastName: 'Flintstone'
      })
      .then(function (response) {
        this.showModal = false
      })
      .catch(function (error) {
        console.log(error)
      })
    }
  }
}

</script>

<style>

.addmeButton {
  z-index:10;
  position:fixed;
  right:10px;
  bottom:10px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  font-size: 30px;
  color: #eee;
  font-weight:700;
  line-height: 50px;
  text-align: center;
  background: #afaf60;
}
.addmeButton:hover {
  background: lightgreen;
}

.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  max-width:300px;
  width:95%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.button{border:1px solid #c0c0c0;
font-size:13px;
border-radius:20px;
padding:10px 20px;
text-transform:uppercase;
margin:0px 10px;}
.btn-submit{
background-color:#00cf00;
color:#fff;
}

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.input{border:1px inset;
padding:6px;
border-radius:3px;
width:80%;
margin:5px;
font-size:14px;
}
</style>
