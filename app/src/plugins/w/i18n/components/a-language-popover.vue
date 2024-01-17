<template>
	<div class="language-dropdown">
		<div class="selected-language" @click="toggleDropdown">
			<span :class="`flag ${selectedLanguage.flag}`" :style="{ backgroundImage: `url('${bg}')` }"></span>
			<span v-if="!mobile">{{ selectedLanguage.title }}</span>
		</div>
		<ul v-if="showDropdown" class="language-list">
			<li v-for="item in $w18n.availableLanguages" :key="item.id" @click="languageSelected(item)">
			<span :class="`flag ${item.flag}`" :style="{ backgroundImage: `url('${bg}')` }"></span>{{ item.title }}
			</li>
		</ul>
	</div>
</template>

<script>
import bg 						from "./img/flags.png"
import { popoverController } 	from "@ionic/vue"

export default {
	props: {
		mobile: {
			type: Boolean,
			required: false,
			default: false
		},
	},

	data() {
		return {
			bg,
			showDropdown: false,
      		selectedLanguage: this.$w18n.availableLanguages[0],
		}
	},

	methods: {
		toggleDropdown() {
      		this.showDropdown = !this.showDropdown;
    	},

		languageSelected(language) {
			console.log(language + ' ' + language.title)
			this.showDropdown = false
			this.selectedLanguage = language
			this.$w18n.changeLanguage(language)
			this.eventBus.emit("language-changed", language)
			// popoverController.dismiss()
		}
	}
}
</script>

<style lang="sass" scoped>
.language-dropdown
	position: relative
	display: inline-block
	width: 150px

.selected-language
	cursor: pointer
	display: flex
	align-items: center
	padding: 10px

.language-list
	position: absolute
	top: 100%
	left: 0
	list-style: none
	padding: 0
	background-color: #fff
	border: 1px solid black
	border-top: none
	border-radius: 0 0 5px 5px
	z-index: 3

.language-list li
	display: flex
	align-items: center
	padding: 10px
	cursor: pointer
	color: #333
	border-top: 1px solid black
	transition: background-color 0.2s
	&:hover
		cursor: pointer !important
		background-color: #f0f0f0

.language-list li
	padding: 10px
	cursor: pointer
	&:hover
		cursor: pointer !important
		background-color: #ccc

.flag
	width: 52px
	height: 39px
	transform: scale(0.5)

	&.sk
		background-position: 0 -8569px

	&.en
		background-position: 0 -3444px

	&.cz
		background-position: 0 -2337px

	&.pl
		background-position: 0 -7626px

ion-item
	color: #fff
	--background: #2C2E30
	--border-color: #2C2E30
	&:hover
		cursor: pointer !important
		--background: #7e7f80
</style>
