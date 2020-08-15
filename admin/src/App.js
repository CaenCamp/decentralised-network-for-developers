import React from "react";
import { HydraAdmin, fetchHydra, hydraDataProvider } from "@api-platform/admin"; // ResourceGuesser, 
import { Resource } from 'react-admin';
import { parseHydraDocumentation } from "@api-platform/api-doc-parser";

import Organizations from './Organizations';
import People from './People';
import Places from './Places';
import Events from './Events';
import CreativeWork from './CreativeWorks';
import Media from './Medias';
import Video from './Videos';
import LearningResourceTypes from './LearningResourceType';

const entrypoint = process.env.REACT_APP_API_ENTRYPOINT;

const dataProvider = hydraDataProvider(
    entrypoint,
    fetchHydra,
    parseHydraDocumentation,
    true // useEmbedded parameter
);

export default () => (
    <HydraAdmin
        dataProvider={ dataProvider }
        entrypoint={ entrypoint }
    >
        <Resource name="people" {...People} />
        <Resource name="places" {...Places} />
        <Resource name="events" {...Events} />
        <Resource name="creative_works" {...CreativeWork} />
        <Resource name="media_objects" {...Media} />
        <Resource name="video_objects" {...Video} />
        <Resource name="organizations" {...Organizations} />
        <Resource name="learning_resource_types" {...LearningResourceTypes} />
  </HydraAdmin>
);
