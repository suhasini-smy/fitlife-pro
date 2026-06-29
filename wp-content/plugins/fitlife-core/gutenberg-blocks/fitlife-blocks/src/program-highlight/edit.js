import {
    RichText,
    InspectorControls,
    useBlockProps
} from '@wordpress/block-editor';

import {
    PanelBody,
    TextControl,
    SelectControl
} from '@wordpress/components';

export default function Edit({ attributes, setAttributes }) {

    const {
        title,
        description,
        buttonText,
        buttonUrl,
        difficulty
    } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title="Settings">

                    <TextControl
                        label="Button Text"
                        value={buttonText}
                        onChange={(value) =>
                            setAttributes({ buttonText: value })
                        }
                    />

                    <TextControl
                        label="Button URL"
                        value={buttonUrl}
                        onChange={(value) =>
                            setAttributes({ buttonUrl: value })
                        }
                    />

                    <SelectControl
                        label="Difficulty"
                        value={difficulty}
                        options={[
                            { label: 'Beginner', value: 'Beginner' },
                            { label: 'Intermediate', value: 'Intermediate' },
                            { label: 'Advanced', value: 'Advanced' }
                        ]}
                        onChange={(value) =>
                            setAttributes({ difficulty: value })
                        }
                    />

                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps()}>

                <RichText
                    tagName="h2"
                    value={title}
                    placeholder="Program Title"
                    onChange={(value) =>
                        setAttributes({ title: value })
                    }
                />

                <RichText
                    tagName="p"
                    value={description}
                    placeholder="Program Description"
                    onChange={(value) =>
                        setAttributes({ description: value })
                    }
                />

                <span>{difficulty}</span>

            </div>
        </>
    );
}