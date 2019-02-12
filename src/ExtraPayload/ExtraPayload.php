<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\ExtraPayload;

use BitWasp\Bitcoin\Collection\StaticBufferCollection;
use BitWasp\Bitcoin\Serializer\ExtraPayload\ExtraPayloadSerializer;
use BitWasp\Buffertools\BufferInterface;

class ExtraPayload extends StaticBufferCollection implements ExtraPayloadInterface
{
    /**
     * @return \BitWasp\Buffertools\BufferInterface
     */
    public function getBuffer(): BufferInterface
    {
        return (new ExtraPayloadSerializer())->serialize($this);
    }

    public function getSize(): int
    {
        $extra_payload = (new ExtraPayloadSerializer())->serialize($this);

        return $extra_payload->getSize();
    }

    public function getHex(): string
    {
        $extra_payload = (new ExtraPayloadSerializer())->serialize($this);

        return $extra_payload->getHex();
    }
}
