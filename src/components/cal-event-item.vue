<template>
  <div class="wrapper">
    <p>
      <span><b>{{event.title}}</b></span> - {{event.desc}}
    </p>
    <p>
      <span class="meta req-to-human" v-for="opt in event.options">{{toHuman(opt)}}</span>
    </p>
  </div>
</template>
<script>
import i18n from '../i18n.js'
import { dateTimeFormatter } from '../tools.js'
export default {
  data () {
    return {
      i18n
    }
  },
  props: {
    event: {
      type: Object,
      required: true
    },
    index: {
      type: Number,
      required: true
    },
    locale: {
      type: String,
      required: true
    },
    role: {
      type: String,
      required: false,
    }
  },
  methods: {
    dateTimeFormatter,
    toHuman(str) {

      if( str == 'req_PL' )
        return 'tarvitsee PL-mesun'
      if( str == 'req_RD' )
        return 'tarvitsee radiokouluttajan'
      if( str == 'req_vPK' )
        return 'tarvitsee vapaapudotuskouluttajan'
      if( str == 'req_TDM' )
        return 'tarvitsee TDM-hyppymestarin'
     if( str == 'req_NOVA' )
        return 'tarvitsee NOVA-mesun'

     if( str == 'PL' )
        return 'PL-mesu'
      if( str == 'RD' )
        return 'radiokouluttaja'
      if( str == 'VPK' )
        return 'vapaapudotuskouluttaja'
      if( str == 'TDM' )
        return 'TDM-mesu'
     if( str == 'NOVA' )
        return 'NOVA-mesu'
  

      return ''
    }
  }
}

</script>