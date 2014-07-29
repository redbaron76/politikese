<?php

/**
 * Sync articoli
 */
Event::listen('articoli.save', function($model, $articoli)
{
	if(is_array($articoli))
	{
		$model->articoli()->sync($articoli);
	}
});

/**
 * Sync preposizioni
 */
Event::listen('preposizioni.save', function($model, $preposizioni)
{
	if(is_array($preposizioni))
	{
		$model->preposizioni()->sync($preposizioni);
	}
});

/**
 * Save and sync tags
 */
Event::listen('tags.save', function($model, $tags)
{
	if(is_array($tags))
	{

		$old_tags = [];
		$new_tags = [];

		// Get old and new values
		foreach ($tags as $value)
		{
			if(is_numeric($value))
			{
				$old_tags[] = $value;
			}
			else
			{
				$new_tags[] = $value;
			}
		}

		// Sync old values
		$model->tags()->sync($old_tags);

		// Write new tags
		foreach ($new_tags as $new_tag)
		{
			$tag_created = Tag::create(['text' => $new_tag]);

			$model->tags()->save($tag_created);
		}

	}
});