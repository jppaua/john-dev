<template>
	<li class="dropdown" v-if="notifications.length">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<span class="fa fa-bell fa-lg"></span>
		</a>

		<ul class="dropdown-menu">
			<li v-for="notification in notifications">
				<a class="listColor" :href="notification.data.link" v-text="notification.data.message" @click.prevent="markAsRead(notification)"></a>
			</li>
		</ul>
	</li>
</template>

<script>
	export default {
		data() {
			return { notifications: false }
		},

		created() {
			axios.get("/profiles/" + window.App.user.name + "/notifications").then(response => this.notifications = response.data);
		},

		methods: {
			markAsRead(notification) {
				axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id)
			}
		}
	}
</script>

<style>
	.dropdown-toggle {
		color: rgba(0,0,0,.5);
	}
	.dropdown-toggle:hover {
		color: rgba(0,0,0,.9);
	}
	.listColor {
		color: rgba(0,0,0,.5);
		padding-bottom: 8px;
		padding-right: 8px;
		padding-top: 8px;
		padding-left: 8px;
		display:block;
	}
	.listColor:hover {
		color: rgba(0,0,0,.9);
		padding-bottom: 8px;
		padding-right: 8px;
		padding-top: 8px;
		padding-left: 8px;
		display:block;
		text-decoration: none;
	}
</style>