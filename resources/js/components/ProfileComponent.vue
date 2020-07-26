<template>
    <div class="relative">
        <div class="ml-3 relative">
            <div>
                <button @click="isOpen = !isOpen" class="max-w-xs flex items-center text-sm rounded-full text-white focus:outline-none focus:shadow-solid" id="user-menu" aria-label="User menu" aria-haspopup="true" x-bind:aria-expanded="open">
                  <img class="h-8 w-8 rounded-full border-2 border-gray-400 hover:border-white" :src="profileimage" alt="" />
                </button>
              </div>
              <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 bg-black opacity-25 cursor-default h-full w-full" style="z-index: 9998"></button>
              <div v-if="isOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg" style="z-index: 9999">
                <div class="py-1 rounded-md bg-white shadow-xs">
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">{{ name }}</a>
                  <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Perfil</a> -->
                  <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a> -->
                  <a :href="rotalogout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sair</a>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                isOpen: false
            }
        },
        props: ['rotalogout', 'profileimage', 'name'],
        created() {
            const handleEscape = (e) => {
                if (e.key === 'Esc' || e.key === 'Escape'){
                    this.isOpen = false
                }
            }
            document.addEventListener('keydown', handleEscape)
            this.$once('hook:beforeDestroy', () => {
                document.removeEventListener('keydown', handleEscape)
            })
        }
    }
</script>