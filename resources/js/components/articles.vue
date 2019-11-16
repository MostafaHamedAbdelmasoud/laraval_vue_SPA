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
export default {
  
    mounted(){
        console.log('hello world')
    }
}
</script>