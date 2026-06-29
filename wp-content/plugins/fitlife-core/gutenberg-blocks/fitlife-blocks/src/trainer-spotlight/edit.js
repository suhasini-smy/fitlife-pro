import { useEffect, useState } from '@wordpress/element';
import { SelectControl } from '@wordpress/components';
import { useBlockProps } from '@wordpress/block-editor';

export default function Edit( { attributes, setAttributes } ) {

    const [ trainers, setTrainers ] = useState( [] );

    useEffect( () => {

        // fetch( '/wp-json/wp/v2/fitlife_trainer' )
        fetch('/fitlifecore/index.php?rest_route=/wp/v2/fitlife_trainer')
            .then( ( response ) => response.json() )
            .then( ( data ) => {
                setTrainers( data );
            } );

    }, [] );

    return (
        <div { ...useBlockProps() }>

            <SelectControl
                label="Select Trainer"
                value={ attributes.trainerId }
                options={ [
                    { label: 'Select Trainer', value: 0 },

                    ...trainers.map( ( trainer ) => ( {
                        label: trainer.title.rendered,
                        value: trainer.id,
                    } ) ),
                ] }
                onChange={ ( value ) =>
                    setAttributes( {
                        trainerId: parseInt( value, 10 ),
                    } )
                }
            />

        </div>
    );
}