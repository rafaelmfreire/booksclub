<template>
<div>
    <div class="mt-12 sm:mt-6 align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" @click="sort($event, 'title')" class="flex items-center">
                            Título
                            <svg v-if="sortDirection == 'desc' && sortProperty == 'title'" fill="currentColor" viewBox="0 0 20 20" class="fill-current h-4 w-4 ml-1"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            <svg v-if="sortDirection == 'asc' && sortProperty == 'title'" fill="currentColor" viewBox="0 0 20 20" class="fill-current h-4 w-4 ml-1"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                        </a>
                    </th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                        <a href="#" @click="sort($event, 'score')" class="flex items-center justify-end">
                            Pontuação
                            <svg v-if="sortDirection == 'desc' && sortProperty == 'score'" fill="currentColor" viewBox="0 0 20 20" class="fill-current h-4 w-4 ml-1"><path d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                            <svg v-if="sortDirection == 'asc' && sortProperty == 'score'" fill="currentColor" viewBox="0 0 20 20" class="fill-current h-4 w-4 ml-1"><path d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr class="hover:bg-yellow-50 odd:bg-gray-100"
                    v-for="(row, index) in listOrder" :key="index" ref="resultsList">

                    <td class="px-6 py-4 border-b border-gray-200">
                        <div class="text-base leading-5 font-medium">
                            <!-- <a :href="`/books/${row.id}`" class="cursor-pointer text-indigo-700 hover:text-indigo-900 hover:underline"> -->
                                {{ row.title }}
                            <!-- </a> -->
                        </div>

                        <!-- <div class="text-xs leading-5 text-gray-500">
                            {{ row.author }}
                        </div>  -->
                    </td>
                    <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-500">
                            {{ row.score }}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            list: [],
            sortProperty: 'score',
            sortDirection: 'desc',
            apiToken_prop: this.apiToken,
            electionId_prop: this.electionId,
            show: false,
            pagination: [],
            loading: false,
        }
    },
    props: ['apiToken', 'electionId'],
    methods: {
        getResults(electionId, token) {

                axios.get(`/api/v1/elections/${electionId}/votes/list?api_token=${token}`)
                .then(result => { this.list = result.data })
        },
        sort( ev, property ){
            ev.preventDefault()

            this.sortProperty = property
            if(this.sortDirection == 'asc'){
                this.sortDirection = 'desc'
            } else {
                this.sortDirection = 'asc'
            }
        },
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
    },
    computed: {
        listOrder: function() {
            return _.orderBy(this.list, this.sortProperty, this.sortDirection)
        }
    },
    mounted() {
        this.getResults(this.electionId_prop, this.apiToken_prop)
    },
}
</script>
<style>
.has-tooltip:hover {
position: relative;
}

.has-tooltip:hover span {
display: block;
}
</style>