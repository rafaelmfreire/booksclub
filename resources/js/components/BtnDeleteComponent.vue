<template>
    <div class="inline-flex ">
        <form method="POST" :action="route+id" ref="formDelete">
            <slot></slot>
            <button v-if="link" @click="submitDelete('Tem certeza?', $event)" class="text-red-600 hover:text-red-900 focus:outline-none focus:underline">Excluir</button>
            <span v-if="button" class="sm:ml-2 shadow-sm rounded-md">
                <button @click="submitDelete('Tem certeza?', $event)"
                class="inline-flex items-center px-4 py-3 sm:py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-red-600 hover:bg-red-500 focus:outline-none focus:shadow-outline-red focus:border-red-700 active:bg-red-700 transition duration-150 ease-in-out">
                    <svg class="sm:-ml-1 sm:mr-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3.389 7.113L4.49 18.021c.061.461 2.287 1.977 5.51 1.979 3.225-.002 5.451-1.518 5.511-1.979l1.102-10.908C14.929 8.055 12.412 8.5 10 8.5c-2.41 0-4.928-.445-6.611-1.387zm9.779-5.603l-.859-.951C11.977.086 11.617 0 10.916 0H9.085c-.7 0-1.061.086-1.392.559l-.859.951C4.264 1.959 2.4 3.15 2.4 4.029v.17C2.4 5.746 5.803 7 10 7c4.198 0 7.601-1.254 7.601-2.801v-.17c0-.879-1.863-2.07-4.433-2.519zM12.07 4.34L11 3H9L7.932 4.34h-1.7s1.862-2.221 2.111-2.522c.19-.23.384-.318.636-.318h2.043c.253 0 .447.088.637.318.248.301 2.111 2.522 2.111 2.522h-1.7z" />
                    </svg>
                    <span class="hidden sm:block">
                        Excluir
                    </span>
                </button>
            </span>
        </form>
        <div v-if="show" class="fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center" style="z-index: 9990">
            <div @click="show = false" class="fixed inset-0 transition-opacity">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Excluir
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm leading-5 text-gray-500 whitespace-pre-wrap py-5">Tem certeza que deseja excluir? Esta ação não pode ser desfeita. Todos os dados serão perdidos.</p>
                        </div>
                    </div>
                </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button @click="confirmDelete(id, item)" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                            Excluir
                        </button>
                    </span>
                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button @click="cancelDelete" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                        Cancelar
                    </button>
                </span>
                </div>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                show: false,
                route_prop: this.route,
                apiToken_prop: this.apiToken,
                link_prop: this.link,
                button_prop: this.button
            }
        },
        props: ['route', 'item', 'id', 'button', 'link', 'apiToken'],
        methods: {
            cancelDelete () {
                this.show = false;
            },
            submitDelete: function(message, event) {
                this.show = true;
                event.preventDefault();
            },
            confirmDelete(id, index) {
                let self = this;
                if (this.button_prop) {
                    this.$refs.formDelete.submit();
                } else {
                    axios.delete(this.route_prop+id+"?api_token="+this.apiToken_prop)
                        .then(function(response){
                            self.$emit('clicked', index);
                        });
                }
                this.show = false;
            }
        },
        created() {
            const handleEscape = (e) => {
                if (e.key === 'Esc' || e.key === 'Escape'){
                    this.show = false
                }
            }
            document.addEventListener('keydown', handleEscape)
            this.$once('hook:beforeDestroy', () => {
                document.removeEventListener('keydown', handleEscape)
            })
        }
    }
</script>