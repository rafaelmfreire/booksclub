<template>
<div>
  <transition name="fade">
    <div v-if="show" class="px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
        <div class="flex items-center rounded-md text-sm font-medium px-4 py-4 mt-6 justify-between transition-all ease-in duration-200" :class="variation" role="alert">
            <div class="flex items-center">
                <svg v-if="variation=='danger'" class="fill-current h-5 w-5 mr-2 transition-all ease-in duration-200" fill="currentColor" viewBox="0 0 20 20"> <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path> </svg>
                <svg v-if="variation=='info'" class="fill-current h-5 w-5 mr-2 transition-all ease-in duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <svg v-if="variation=='warning'" class="fill-current h-5 w-5 mr-2 transition-all ease-in duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <svg v-if="variation=='success'" class="fill-current h-5 w-5 mr-2 transition-all ease-in duration-200" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
              <p><slot></slot></p>
            </div>
            <svg fill="currentColor" @click="show=false" class="fill-current h-5 w-5 cursor-pointer" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </div>
    </div>
  </transition>
</div>
</template>
 
<script>
  export default {
    data () {
      return {
        show: true,
      }
    },
    props: ['variation'],
  }
</script> 

<style>

.danger { @apply text-red-600 bg-red-100 border border-red-300; }
.danger:hover  { @apply border-red-500 text-red-700; }
.danger svg { @apply text-red-400; }
.danger:hover svg { @apply text-red-500; }

.info { @apply text-blue-600 bg-blue-100 border border-blue-300; }
.info:hover  { @apply border-blue-500 text-blue-700; }
.info svg { @apply text-blue-400; }
.info:hover svg { @apply text-blue-500; }

.success { @apply text-green-600 bg-green-100 border border-green-300; }
.success:hover  { @apply border-green-500 text-green-700; }
.success svg { @apply text-green-400; }
.success:hover svg { @apply text-green-500; }

.warning { @apply text-yellow-600 bg-yellow-100 border border-yellow-500; }
.warning:hover  { @apply border-yellow-600 text-yellow-700; }
.warning svg { @apply text-yellow-600; }
.warning:hover svg { @apply text-yellow-700; }

.fade-leave-active {
    opacity: 0;
    transition: opacity 0.5s;
}
</style>