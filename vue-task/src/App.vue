<template>
  <div id="app">
    <Navbar/>
		<div class="container">
			<transition name="fade" mode="out-in">
				<router-view></router-view>
			</transition>
		</div>
  </div>
</template>

<script>
import Navbar from './components/Navbar.vue'

export default {
  name: 'app',
  components: {
    Navbar
  }
}
</script>

<style>

</style>
