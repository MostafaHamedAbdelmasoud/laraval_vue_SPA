<template>
	<div>
		<h2>Article</h2>
		

		<form @submit.prevent='addArticle'>
			<div class="form-group">
				 <input type="text" class="form-control" placeholder="Title" v-model="article.title">
			</div>
			<div class="form-group">
				<textarea class="form-control" placeholder="body" v-model="article.body"></textarea>
			</div>

			<div>				
				<button type='submit' class="btn btn-success ">Save</button>
			</div>

		</form>


		<br>
		<nav aria-label="Page navigation example">
		  <ul class="pagination">
		    <li v-bind:class="[{disabled : !pagination.prev_page_url}]" class="page-item"><a 
		    	@click="fetchArticles(pagination.prev_page_url)"
		    	class="page-link" href="#">Previous</a></li>
		    <!-- v-bind:class="[{disabled : !pagination.prev_page_url}]"
		    means disabled if there is no previous page url -->
		    <li class="page-item"><a class="page-link disabled text-dark" href="#">page {{pagination.current_page}} of {{pagination.last_page}}</a></li>

		    <li v-bind:class="[{disabled : !pagination.next_page_url}]" class="page-item"><a
		     @click="fetchArticles(pagination.next_page_url)"
		     class="page-link" href="#">Next</a></li>
		  </ul>
		</nav>
		<div class="card card-body mb-2" v-for='article in articles' v-bind:key="article.id"><!-- v-bind:key="article.id" for the wierd error  -->
		<div class="container">
			<div class="row">
				<div class="md-6">
					<h3 class="m-2">{{article.title}}</h3>
				</div>
				<div class="md-6 pl-5">
					<div>
				<a @click="editArticle(article)" href="#" class='btn btn-warning m-2'>Edit</a>

				<button @click="deleteArticle(article.id)" class='btn btn-danger'>Delete</button>
			</div>	
				</div>

			</div>

		</div>
			<!-- <h3 class="m-2">{{article.title}}</h3> -->
			<!-- <div>
				<a @click="editArticle(article)" href="#" class='btn btn-warning m-2'>Edit</a>

				<button @click="deleteArticle(article.id)" class='btn btn-danger'>Delete</button>
			</div>	 -->
			<hr>
			<p class="m-2">{{article.body}}</p>
			<hr>
			
		</div>
	</div>
</template>
<script>
import axios_http from 'axios'

	export default{
		data(){
			return {
				articles:[],

				article:{

				id:'',
				title:'',
				body:''

				},

				article_id:'',

				pagination:{},

				edit:false
			}
			
		},

		created(){
			this.fetchArticles();
		},

		methods:{
			fetchArticles(page_url)
			{
				let vm =this;
				page_url=page_url || 'api/articles';
				//page_url=page_url means if it's passed to the function
				fetch(page_url)
				.then(res => res.json())
				//returns A promise that resolves with the result of parsing the body text as JSON
				.then(res=>{//this is a response for th last resposnse
					// console.log(res);
					this.articles=res.data;
					vm.makePagination(res.meta,res.links);
				})
				.catch(err => console.log(err));
			}
			,
			makePagination(meta,links)
			{
				let pagination = {

					current_page:meta.current_page,

					last_page:meta.last_page,

					next_page_url:links.next,

					prev_page_url:links.prev

				};
				this.pagination = pagination;
			},
			deleteArticle(id)
			{
				if(confirm('Are You Sure?'))
					//confirm() is like alert
				{
					fetch('api/article/'+id,{
						method:'delete'
					})
					.then(res => res.json())
					.then(data =>{
						alert('Article Removed');
						this.fetchArticles();//this will reload the first page
					})
					.catch(err => console.log(err));
				}
			},
			addArticle()
			{
				if(this.edit === false)
				{
					//add
					fetch('api/article',
					{
						method:'post',
						body: JSON.stringify(this.article),
						//JSON.stringify() used to convert object to sting ,json sting
						headers:{
							'content-type':'application/json'
						}
					})
					.then(res =>res.json())
					.then(data =>{
						this.article.title = '';
						this.article.body= '';
						//to return as they was
						alert('Article Added');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}
				else
				{
					//update
					fetch('api/article',
					{
						method:'put',
						body: JSON.stringify(this.article),
						//JSON.stringify() used to convert object to sting ,json sting
						headers:{
							'content-type':'application/json'
						}
					})
					.then(res =>res.json())
					.then(data =>{
						this.article.title = '';
						this.article.body= '';
						//to return as they was
						alert('Article Updated');
						this.fetchArticles();
					})
					.catch(err => console.log(err));
				}
			},
			editArticle(article)
			{
				this.edit= true;
				this.article.article_id = article.id;
				this.article.id =  article.id;
				this.article.title = article.title;
				this.article.body = article.body;
			}
			
		}
	}
</script>