<template>
  <div>
    <div class="addmeButton" @click="showModal = true"> + </div>

    <div v-if="showModal" id="addmemodal">
      <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <form v-on:submit="addJumper">
     
                <div class="modal-header">
                  <slot name="header">
                    I wanna jump too!
                  </slot>
                </div>

                <div class="modal-body">
                  <slot name="body">

                    <input type="date" class="input" name="date" v-model="jumperDate"> 
                    <input type="text" class="input" name="name" placeholder="Nimi" v-model="jumperName">  
                    <input type="text" class="input" name="notes" placeholder="paikka klo, huomioita" v-model="jumperNotes">

                    <select name="role" class="input form-control" v-model="jumperRole">
                      <option value="pilot">Pilot</option>
                      <option value="student">Student</option>
                      <option value="licensed">Licensed</option>
                    </select>

                    <div class="roleoptions" v-if="this.jumperRole == 'student'">

                      <span class="meta">Tarvitsen:</span><br>
                      <div class="roleoption">
                        <input id="req_PL" type="checkbox" value="req_PL" v-model="studentOptions" class="form-control"> 
                        <label for="req_PL">PL-hyppymestarin</label>
                      </div>

                      <div class="roleoption">
                        <input id="req_RD" type="checkbox" value="req_RD" v-model="studentOptions" class="form-control">
                        <label for="req_RD">radiokouluttajan</label>
                      </div>

                      <div class="roleoption">
                        <input id="req_VPK" type="checkbox" value="req_VPK" v-model="studentOptions" class="form-control">
                        <label for="req_VPK">vapaapudotuskouluttajan</label>
                      </div>

                      <div class="roleoption">
                        <input id="req_NOVA" type="checkbox" value="req_NOVA" v-model="studentOptions" class="form-control">
                        <label for="req_NOVA">NOVA-hyppymestarin</label>
                      </div>

                      
                      <div class="roleoption">
                        <input id="req_TDM" type="checkbox" value="req_TDM" v-model="studentOptions" class="form-control">
                        <label for="req_TDM">TANDEM-hyppymestarin</label>
                      </div>

                    </div>

                    <div class="roleoptions" v-if="this.jumperRole == 'licensed'">

                      <span class="meta">Olen:</span><br>

                      <div class="roleoption">
                        <input id="PL" type="checkbox" value="PL" v-model="licensedOptions" class="form-control">
                        <label for="PL">PL-HM</label>
                      </div>

                      <div class="roleoption">
                        <input id="RD" type="checkbox" value="RD" v-model="licensedOptions" class="form-control">
                        <label for="RD">RADIO</label>
                      </div>

                      <div class="roleoption">
                        <input id="VPK" type="checkbox" value="VPK" v-model="licensedOptions" class="form-control">
                        <label for="VPK">VPK</label>
                      </div>

                      <div class="roleoption">
                        <input id="TDM" type="checkbox" value="TDM" v-model="licensedOptions" class="form-control">
                        <label for="TDM">TDM</label>
                      </div>

                      <div class="roleoption">
                        <input id="NOVA" type="checkbox" value="NOVA" v-model="licensedOptions" class="form-control">
                        <label for="NOVA">NOVA</label>
                      </div>

                    </div>
                    

                  </slot>
                </div>

                <div class="modal-footer">
                  <slot name="footer">
                    
                    <button  type="submit" class="button btn-submit">
                      Submit
                    </button>

                    <button class="button btn-cancel" @click="showModal = false">
                      Cancel
                    </button>

                  </slot>
                </div>
              </form>
            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>

import axios from 'axios'
import calendar from './Calendar.vue'

export default {
  data: () => ({
    showModal: false,
    jumperName: '',
    jumperDate: '',
    jumperNotes: '',
    jumperRole: '',
    licensedOptions: [],
    studentOptions: []
  }),
  methods: {
    addJumper (e) {
      e.preventDefault()

      let jumperOptions = []
      if( this.jumperRole == 'licensed' )
        jumperOptions = this.licensedOptions
      if( this.jumperRole == 'student' )
        jumperOptions = this.studentOptions

      axios({
        method: 'post',
        url: './server/api/jumpers/',
        data: {
          date: this.jumperDate,
          name: this.jumperName,
          notes: this.jumperNotes,
          role: this.jumperRole,
          options: jumperOptions
        }
      })
      .then(response => {
        this.showModal = false
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

.input{
  border:1px inset;
  padding:6px;
  border-radius:3px;
  width:80%;
  margin:5px;
  font-size:14px;
}

select.form-control{width:85%;background-color:#fff;}

.meta,.roleoption label{
  font-size:14px;text-align:left;
}
.roleoptions{
  text-align:left;
  margin-left:25px;
}
.roleoption{
  padding-bottom:5px;
}

</style>
