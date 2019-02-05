<?php

declare(strict_types=1);

namespace BitWasp\Bitcoin\Serializer\ExtraPayload;

use BitWasp\Bitcoin\ExtraPayload\ExtraPayload;
use BitWasp\Bitcoin\ExtraPayload\ExtraPayloadInterface;
use BitWasp\Bitcoin\Serializer\Types;
use BitWasp\Buffertools\Buffer;
use BitWasp\Buffertools\BufferInterface;
use BitWasp\Buffertools\Parser;

class ExtraPayloadSerializer
{
    /**
     * @var \BitWasp\Buffertools\Types\VarString
     */
    private $varstring;

    /**
     * @var \BitWasp\Buffertools\Types\VarInt
     */
    private $varint;

    /**
     * @var \BitWasp\Buffertools\Types\Int8
     */
    protected $int8le;

    /**
     * @var \BitWasp\Buffertools\Types\Uint8
     */
    protected $uint8le;

    public function __construct()
    {
        $this->varstring = Types::varstring();
        $this->varint = Types::varint();
        $this->int32le = Types::int8le();
        $this->uint32le = Types::uint8le();
    }

    /**
     * @param Parser $parser
     * @return ExtraPayloadInterface
     */
    public function fromParser(Parser $parser): ExtraPayloadInterface
    {
        $extra_payload_size = $this->varint->read($parser);

        if ($extra_payload_size > $parser->getSize() - $parser->getPosition()) {
            throw new ParserOutOfRange("Insufficient data remaining for Extra Payload");
        }

        $extraPayloadBuffer = $parser->readBytes((int) $extra_payload_size);

        return new ExtraPayload($extraPayloadBuffer);
    }

    /**
     * @param ExtraPayloadInterface $extra_payload
     * @return BufferInterface
     */
    public function serialize(ExtraPayloadInterface $extra_payload): BufferInterface
    {
        return $extra_payload[0];
    }
}
