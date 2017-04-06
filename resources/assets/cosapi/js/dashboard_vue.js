Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#tokenId').getAttribute('value')

const vm = new Vue({
  el: '#detail_agents',
  data: {
    agents: []
  }
})

var kpi = new Vue({
  el: '#kpi',
  data: {
    answered: '-',
    answeredTime: '-',
    abandonedTime: '-',
    abandoned: '-',
    slaDay: '-',
    queue: '-',
    abandonedSimbolo: '',
    abandonedSecond: '',
    answeredSimbolo: '',
    answeredSecond: ''
  },
  mounted(){
    this.loadAnswered()
    this.loadAbandoned()
    this.loadAnsweredTime()
    this.loadAbandonedTime()
    //this.loadSlaDay()
    //this.loadQueue()
  },
  methods:{
    loadAnswered: function(){
      this.answered = '-'
      let parameters = {type : 'calls_completed'}
      this.$http.post('dashboard_01/getEventKpi',parameters).then(response => {
        this.answered = response.data.message
      },response =>{
        console.log(response.body.message)
      })
    },
    loadAbandoned: function(){
      this.abandoned = '-'
      let parameters = {type : 'calls_abandone'}
      this.$http.post('dashboard_01/getEventKpi',parameters).then(response => {
        this.abandoned = response.data.message
      },response =>{
        console.log(response.body.message)
      })
    },
    loadAnsweredTime: function(){
      this.answeredTime = '-'
      let parameters = {
        type : 'calls_completed',
        time : 'true'
      }
      this.$http.post('dashboard_01/getEventKpi',parameters).then(response => {
        this.answeredTime = response.data.message
        this.answeredSecond = response.data.time
        this.answeredSimbolo = response.data.simbolo
      },response =>{
        console.log(response.body.message)
      })
    },
    loadAbandonedTime: function(){
      this.abandonedTime = '-'
      let parameters = {
        type : 'calls_abandone',
        time : 'true'
      }
      this.$http.post('dashboard_01/getEventKpi',parameters).then(response => {
        this.abandonedTime = response.data.message
        this.abandonedSecond = response.data.time
        this.abandonedSimbolo = response.data.simbolo
      },response =>{
        console.log(response.body.message)
      })
    },
    loadSlaDay: function(){
      //this.slaDay = 14
    },
    loadQueue: function(){
      //this.queue = 15
    }
  }
})


var socket = io.connect('http://192.167.99.246:3363', { 'forceNew': true })
socket.emit('connect_dashboard')

socket.on('QueueMemberAdded', data => {
  vm.agents.push(data['QueueMemberAdded'])
})

socket.on('QueueMemberRemoved', data => {
  for (agent in vm.agents) {
    if (vm.agents.hasOwnProperty(agent)) {
      if (vm.agents[agent]['number_annexed'] === data['NumberAnnexed']){
        vm.agents.splice(agent, 1)
      }
    }
  }
})

socket.on('QueueMemberChange', data => {
  console.log(data)
  for (agent in vm.agents) {
    if (vm.agents.hasOwnProperty(agent)) {
      if (vm.agents[agent]['number_annexed'] === data['NumberAnnexed']){
        vm.agents.splice(agent, 1, data['QueueMemberChange'])
      }
    }
  }
})
