<template>
    <div id="wrapper">

        {{results}}

    </div>
</template>

<script>
    export default{
        data(){
            return {
                query: '',
                // url: '/api/articles',
                results: []
            }
        },
        created () {
    // fetch the data when the view is created and the data is
    // already being observed
    this.fetchData()
    },
        methods: {
            autoComplete(){
                var results = [];
                // if(this.query.length > 2){
                    getPost('/api/test2').then(response => {
                        results.push(response.data.json());
                        console.log(response);
                    })
                    .then(err => console.log(err));
                // }
            }
    }
}
</script>