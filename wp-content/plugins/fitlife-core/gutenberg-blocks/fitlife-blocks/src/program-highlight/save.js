import { RichText, useBlockProps } from '@wordpress/block-editor';

export default function save({ attributes }) {

    return (
        <div {...useBlockProps.save()}>

            <RichText.Content
                tagName="h2"
                value={attributes.title}
            />

            <RichText.Content
                tagName="p"
                value={attributes.description}
            />

            <span>{attributes.difficulty}</span>

            <a href={attributes.buttonUrl}>
                {attributes.buttonText}
            </a>

        </div>
    );
}